<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a class="text-primary" href="/back/upkeeps">Mantenimientos</a>
    </li>
    <li class="breadcrumb-item active text-primary">Empleados</li>
</ol>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">COLABORADORES</h5>
                <input type="hidden" id="actionEmployee" value="paginate">
                <input type="hidden" id="typeRequestEmployee" value="GET">
                <input type="hidden" id="numberPageEmployee" name="numberPageEmployee" value="1">
                <form id="FrmEmployee">
                    <div class="row mt-3">
                        <div class="form-group col-12 col-sm-7 col-md-7 col-lg-7 col-xl-7">
                            <input type="text" name="txtFilterEmployeeSearch" id="txtFilterEmployeeSearch" class="form-control form-control-sm" placeholder="INGRESE DATOS . . .">
                        </div>
                        <div class="form-group col-9 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <select type="text" name="slcGenderEmployeeSearch" id="slcGenderEmployeeSearch" class="form-control form-control-sm">
                                <option value="-1">SELECCIONAR</option>
                                <option value="M">MASCULINO</option>
                                <option value="F">FEMENINO</option>
                            </select>
                        </div>
                        <div class="form-group col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                            <button type="submit" id="btnEmployeeSearch" class="btn btn-primary btn-sm mr-3" data-toggle="tooltip" title="Buscar Employee"><i class="fa fa-search" aria-hidden="true"></i>
                            </button>

                        </div>
                        <div class="form-group col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 ">
                            <button type="button" id="btnCreateEmployee" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Agregar Employee"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive-sm">
                            <table class="table table-hover table-sm">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="align-middle text-center align-middle" style="width: 15%">DNI</th>
                                        <th class="align-middle">NOMBRE</th>
                                        <th style="width: 15%" colspan="2" class="text-center align-middle">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody class="border border-info" id="tbodyEmployee">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 col-sm-3 col-4">
                        <select id="sizePageEmployee" name="sizePageEmployee" class="form-control form-control-sm combo-paginar" idbtnBuscar='btnBuscarEmployee'>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                    <div class="col-md-10 col-sm-9 col-8">
                        <nav aria-label="Page navigation Employee">
                            <ul id="paginationEmployee" class="pagination pagination-sm justify-content-end">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"> <span aria-hidden="true">&raquo;</span> </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modalman" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form class="modal-content" id="formularioModal">
            <div class="modal-header">
                <h5 class="modal-title">REGISTRO PERSONAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row" id="demo">

                    <div class="col-6 mb-3">
                        <label for="txtDniEmployee">N° DNI</label>
                        <input type="text" id="txtDniEmployee" name="txtDniEmployee" class="form-control form-control-sm" maxlength="8" placeholder="N° DOCUMENTO" required>
                        <div class="invalid-feedback">
                            Por favor ingrese un N° de DNI.
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="txtNamesEmployee" id="lblNombreEmployee">NOMBRES</label>
                        <input type="text" id="txtNamesEmployee" name="txtNamesEmployee" class="form-control form-control-sm" maxlength="30" placeholder="NOMBRES" required>
                        <div class="invalid-feedback">
                            Por favor ingrese los Nombres.
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="txtPaternalEmployee">APELLIDO PATNO</label>
                        <input type="text" id="txtPaternalEmployee" name="txtPaternalEmployee" class="form-control form-control-sm" maxlength="30" placeholder="APELLIDO PATNO">
                        <div class="invalid-feedback">
                            Por favor ingrese el Apellido Paterno.
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="txtMaternalEmployee">APELLIDO MATNO</label>
                        <input type="text" id="txtMaternalEmployee" name="txtMaternalEmployee" class="form-control form-control-sm" maxlength="30" placeholder="APELLIDO MATNO">
                        <div class="invalid-feedback">
                            Por favor ingrese el Apellido Materno.
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="slcGenderEmployee">SEXO</label>
                        <select id="slcGenderEmployee" name="slcGenderEmployee" class="form-control form-control-sm">
                            <option value="M">MASCULINO</option>
                            <option value="F">FEMENINO</option>
                        </select>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="txtMobileEmployee">CELULAR</label>
                        <input type="text" maxlength="9" id="txtMobileEmployee" name="txtMobileEmployee" class="form-control form-control-sm" placeholder="CELULAR">
                        <div class="invalid-feedback">
                            Por favor ingrese el n° Celular.
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="txtWeekly_HoursEmployee">HORAS SEMANALES</label>
                        <input type="text" maxlength="9" id="txtWeekly_HoursEmployee" name="txtWeekly_HoursEmployee" class="form-control form-control-sm" placeholder="CELULAR">
                        <div class="invalid-feedback">
                            Por favor ingrese el n° Celular.
                        </div>
                    </div>
                </div>
                <input type="hidden" id="txtIdEmployee" name="txtIdEmployee" value="">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CRAR</button>
                <button type="submit" class="btn btn-primary">GUARDAR</button>
            </div>
        </form>
    </div>
</div> 