import * as THREE from "three";
import { TrackballControls } from "three/addons/controls/TrackballControls.js";
import { GLTFLoader } from "three/addons/loaders/GLTFLoader.js";
import { RoomEnvironment } from "three/addons/environments/RoomEnvironment.js";

// --- DOM Elements ---
const loadingScreen = document.getElementById("loading-screen");
const loadingText = document.getElementById("loading-text");
const errorMessage = document.getElementById("error-message");

// --- Initialization Function for a single viewer ---
function initModelViewer(container) {
    let scene, camera, renderer, controls, model;
    const isProduct = container.closest('.new-product-card') !== null;

    // 1. Setup Scene
    scene = new THREE.Scene();

    // 2. Setup Camera
    camera = new THREE.PerspectiveCamera(
        45,
        container.clientWidth / container.clientHeight,
        1,
        100,
    );
    camera.position.set(0, 2, 6); // Position camera slightly above and pulled back

    // 3. Setup Renderer
    renderer = new THREE.WebGLRenderer({
        antialias: true, // Smooth rendering as requested
        alpha: true, // Transparent background as requested
    });
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.setPixelRatio(window.devicePixelRatio); // Optimize rendering for high DPI displays

    // Restore environment map so metallic materials don't render black
    const pmremGenerator = new THREE.PMREMGenerator(renderer);
    scene.environment = pmremGenerator.fromScene(
        new RoomEnvironment(),
        1.0,
    ).texture;

    // Enable Tone Mapping for correct PBR color rendering
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.7; // Slightly increased exposure

    // Add canvas to DOM
    container.appendChild(renderer.domElement);

    // 4. Setup Lights
    // Ambient light for base illumination
    const ambientLight = new THREE.AmbientLight(0xffffff, 1.5);
    scene.add(ambientLight);

    // To ensure NO side is ever dark, we place a light on all 6 sides (Top, Bottom, Left, Right, Front, Back)
    const intensity = 1.0;
    const lightFront = new THREE.DirectionalLight(0xffffff, intensity);
    lightFront.position.set(0, 0, 1);
    scene.add(lightFront);
    const lightBack = new THREE.DirectionalLight(0xffffff, intensity);
    lightBack.position.set(0, 0, -1);
    scene.add(lightBack);
    const lightTop = new THREE.DirectionalLight(0xffffff, intensity);
    lightTop.position.set(0, 1, 0);
    scene.add(lightTop);
    const lightBottom = new THREE.DirectionalLight(0xffffff, intensity);
    lightBottom.position.set(0, -1, 0);
    scene.add(lightBottom);
    const lightRight = new THREE.DirectionalLight(0xffffff, intensity);
    lightRight.position.set(1, 0, 0);
    scene.add(lightRight);
    const lightLeft = new THREE.DirectionalLight(0xffffff, intensity);
    lightLeft.position.set(-1, 0, 0);
    scene.add(lightLeft);

    // 5. Setup TrackballControls for free 3D rotation (including Z-axis)
    controls = new TrackballControls(camera, renderer.domElement);
    controls.rotateSpeed = 4.0;
    controls.zoomSpeed = 1.2;
    controls.panSpeed = 0.8;
    controls.noZoom = false; // Enable direct zoom
    controls.noPan = true;
    controls.staticMoving = false; // Set to false for damping (smooth inertia)
    controls.dynamicDampingFactor = 0.15; // Smoothness
    // Limit minDistance on Hero model so zoom-in stops before the model goes outside / gets cut off
    controls.minDistance = isProduct ? 2.5 : 4.8;
    controls.maxDistance = 10.0; // Zoom out limit (prevents going too far away)

    // 6. Load the GLB Model
    const loader = new GLTFLoader();
    // Use the data-model attribute if provided, else fallback to default
    const modelPath =
        container.dataset.model || "assets/models/DOUBLE-GIMBAL-ASSEM.glb";

    loader.load(
        modelPath,
        function (gltf) {
            model = gltf.scene;

            // Compute the bounding box of the model to find its center and size
            const box = new THREE.Box3().setFromObject(model);
            const size = box.getSize(new THREE.Vector3());

            // Calculate a scale factor to ensure the model is adequately large
            const maxDim = Math.max(size.x, size.y, size.z);

            const isMobile = window.innerWidth <= 768;

            // Adjust 3D model scale: use 1.7 for product models on desktop so the 3D model itself is smaller/shorter
            const targetSize = isProduct ? (isMobile ? 2.2 : 1.7) : 2.5;

            if (maxDim > 0) {
                const scale = targetSize / maxDim;
                model.scale.set(scale, scale, scale);
            }

            // Recompute the bounding box after scaling to properly center it
            const scaledBox = new THREE.Box3().setFromObject(model);
            const center = scaledBox.getCenter(new THREE.Vector3());

            // Adjust the model's position to center it at the origin (0,0,0)
            model.position.sub(center);

            // Remove any built-in shadows/black spots from the model's materials
            model.traverse((child) => {
                if (child.isMesh && child.material) {
                    child.material.aoMap = null;
                    child.material.aoMapIntensity = 0;
                    child.material.envMapIntensity = 2.0;

                    // Enable anisotropic filtering to prevent blurry textures when scaled up
                    if (child.material.map) {
                        child.material.map.anisotropy = renderer.capabilities.getMaxAnisotropy();
                    }
                    if (child.material.normalMap) {
                        child.material.normalMap.anisotropy = renderer.capabilities.getMaxAnisotropy();
                    }

                    child.material.needsUpdate = true;
                }
            });

            // Add the centered model to the scene
            scene.add(model);

            // Fade out and hide the loading screen
            if (loadingScreen) {
                loadingScreen.style.opacity = "0";
                setTimeout(() => {
                    loadingScreen.style.display = "none";
                }, 500); // Matches the CSS transition duration
            }
        },
        function (xhr) {
            if (xhr.lengthComputable && loadingText) {
                const percentComplete = (xhr.loaded / xhr.total) * 100;
                loadingText.innerText = `Loading... ${Math.round(percentComplete)}%`;
            }
        },
        function (error) {
            console.error("An error happened while loading the model:", error);
            if (loadingScreen) loadingScreen.style.display = "none";
            if (errorMessage) errorMessage.style.display = "block"; // Show error overlay to user
        },
    );

    // 7. Handle Container Resize perfectly to avoid blurry stretching
    const resizeObserver = new ResizeObserver(() => {
        if (!container.clientWidth || !container.clientHeight) return;
        camera.aspect = container.clientWidth / container.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(container.clientWidth, container.clientHeight);
        // Ensure pixel ratio is always optimal
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        controls.handleResize(); // Required for TrackballControls
    });
    resizeObserver.observe(container);

    // 8. Start the Animation Loop
    function animate() {
        requestAnimationFrame(animate);

        // Automatically rotate the model slowly as requested
        if (model) {
            model.rotation.y += 0.005; // Slow rotation around Y-axis
        }

        controls.update();
        renderer.render(scene, camera);
    }

    animate();
}

// --- Bootstrap the Application ---
// Find all elements meant to contain 3D models and initialize them dynamically.
// function initAllViewers() {
//     const containers = document.querySelectorAll(".new-threejs-model-container");
//     containers.forEach((container) => {
//         initModelViewer(container);
//     });
// }

function initAllViewers() {
    const containers = document.querySelectorAll(".new-threejs-model-container");

    // NO 3D MODELS ON THIS PAGE
    if (containers.length === 0) {
        if (loadingScreen) {
            loadingScreen.style.opacity = "0";

            setTimeout(() => {
                loadingScreen.style.display = "none";
            }, 500);
        }
        return;
    }

    containers.forEach((container) => {
        initModelViewer(container);
    });
}

// Run the initialization
initAllViewers();