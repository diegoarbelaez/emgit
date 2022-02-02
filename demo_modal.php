<?php include("conexion.php"); ?>
<?php include("encabezado.php"); ?>
<?php include("nav.php"); ?>

<script src="cropie/jquery.min.js"></script>
  <script src="cropie/bootstrap.min.js"></script>
  <script src="cropie/croppie.js"></script>
  <link rel="stylesheet" href="cropie/croppie.css" />

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Registro No almacenado
                        <div class="page-title-subheading">Error al guardar la información
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fila que contiene la información de la página -->
        <div class="row">
            <div class="col-md-8">
                <div class="main-card mb-6 card">
                    <div class="card-body">
                        <div class="container">
                            <br />
                            <h3 align="center">Image Crop & Upload using JQuery with PHP Ajax</h3>
                            <br />
                            <br />
                            <div class="panel panel-default">
                                <div class="panel-heading">Select Profile Image</div>
                                <div class="panel-body" align="center">
                                    <input type="file" name="upload_image" id="upload_image" />
                                    <br />
                                    <div id="uploaded_image"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div class="card-title">Basic Examples</div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Basic Modal
                        </button>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                            Long Content
                        </button>
                        <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>
                        <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Small modal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <?php include("pie.php"); ?>
</div>
<div id="uploadimageModal" class="modal" role="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload & Crop Image</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 text-center">
                        <div id="image_demo" style="width:350px; margin-top:30px"></div>
                    </div>
                    <div class="col-md-4" style="padding-top:30px;">
                        <br />
                        <br />
                        <br />
                        <button class="btn btn-success crop_image">Crop & Upload Image</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>