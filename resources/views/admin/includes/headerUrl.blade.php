<link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->

<!-- plugin css file  -->

<link rel="stylesheet" href="{{ asset('public/admin/assets/plugin/datatables/responsive.dataTables.min.css')}}">
<link rel="stylesheet" href="{{ asset('public/admin/assets/plugin/datatables/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">


<!-- project css file  -->
<link rel="stylesheet" href="{{ asset('public/admin/assets/css/ebazar.style.min.css') }}"> 
<style>
.loader-wrapper {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(255, 255, 255, 0.8); /* semi-transparent */
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999; /* on top of everything */
}

/* Loader */
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Animation */
@-webkit-keyframes spin { 
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>