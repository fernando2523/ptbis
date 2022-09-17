@extends('layouts.main')
@section('container')


<!-- BEGIN #app -->
    <!-- BEGIN #content -->
    <style>
        .pos-content {
        -ms-overflow-style: none;  /* Internet Explorer 10+ */
        scrollbar-width: none;  /* Firefox */
        }
        .pos-content::-webkit-scrollbar { 
            display: none;  /* Safari and Chrome */
        }
    </style>
    <div class="modal fade" id="modaladd" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-theme">NEW EMPLOYEE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form class="was-validated" enctype="multipart/form-data" method="POST" action="{{ url('/employee/employees/store') }}">
                    @csrf
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-8 form-group position-relative mb-3 mt-3">
                            <label class="form-label">Name</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="names" id="names" required placeholder="Please provide a name" autocomplete="OFF">
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-4 form-group mb-3 mt-3">
                            <label class="form-label">Phone</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="number" name="tlp" id="tlp" required placeholder="Please provide number Phone" autocomplete="OFF">
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-6 form-group mb-2">
                            <label class="form-label">Domisili <small class="text-warning">(kota)</small></label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="domisili" id="domisili"  placeholder="domisili" autocomplete="OFF" required>
                            <div class="valid-feedback">Looks good!</div>
                        </div>

                        <div class="col-6 form-group position-relative mb-2">
                            <label class="form-label">Gender</label>
                            <select class="form-select text-theme" id="gender" name="gender" required>
                                <option value="" disabled selected>Choose Gender</option>
                                <option value="PRIA">PRIA</option>
                                <option value="WANITA">WANITA</option>
                            </select>
                            <div class="invalid-tooltip">
                                Please select a valid gender.
                            </div>
                        </div>
                        <div class="col-6 form-group position-relative mb-2">
                            <label class="form-label">Role</label>
                            <select class="form-select text-theme" name="role" id="role" required>
                                <option value="" disabled selected>Select Role</option>
                                <option value="STAFF-ASSET">STAFF-ASSET</option>
                                <option value="STAFF-ADMIN">STAFF-ADMIN</option>
                                <option value="STAFF-IT">STAFF-IT</option>
                                <option value="HEAD-SECURITY">HEAD-SECURITY</option>
                                <option value="SECURITY">SECURITY</option>
                                <option value="DRIVER">DRIVER</option>
                            </select>
                            <div class="invalid-tooltip">
                                Please select a valid role.
                            </div>
                        </div>
                        <div class="col-6 form-group mb-3">
                            <label class="form-label">Pas Photo <small class="text-warning">optional</small></label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                    </div>
                    <div class="form-group mt-3" align="right">
                        <button class="btn btn-theme" type="submit">Save</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div id="content" class="app-content p-1 ps-xl-4 pe-xl-4 pt-xl-3 pb-xl-3">
        <div class="d-flex align-items-center mt-3">
            <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/land/lands">EMPLOYEE</a></li>
                <li class="breadcrumb-item active">EMPLOYEE PAGE</li>
            </ul>
            
            <h1 class="page-header">
                Employee
            </h1>
            </div>
        </div>
        <div class="mb-sm-3 mb-2 d-sm-flex">
            <div class="mt-sm-0 mt-2r" style="cursor: pointer;" ><a class="btn btn-outline-theme" data-bs-toggle="modal" data-bs-target="#modaladd" class="text-white text-opacity-75 text-decoration-none"><i class="fas fa-plus-circle fa-fw me-1 text-theme"></i>New Employee</a></div>
        </div>
        <div class="input-group mb-3">
            <div class="flex-fill position-relative">
                <form action="/employee/employees/cari" method="GET">
                <div class="input-group">
                    <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">
                        <i class="fa fa-search opacity-5"></i>
                    </div>
                        <input type="text" class="form-control ps-35px" name="cari" value="{{ old('cari') }}" placeholder="Search by name employee.." />
                       <a class="btn btn-outline-default" href="/employee/employees">clear</a>
                </div>
            </form>
            </div>
        </div>
        <div class="pos pos-vertical card" id="pos">
            <div class="pos-container card-body">
                <div class="pos-header">
                    <div class="logo">
                        <a>
                            <div class="logo-img"><i class="bi bi-x-diamond" style="font-size: 1.5rem;"></i></div>
                            <div class="logo-text">DATA EMPLOYEE</div>
                        </a>
                    </div>
                    <div class="time">PT.BUWANA INDONESIA SUBUR</div>
                </div>
                <div class="pos-content">
                    <div class="pos-content-container h-100 p-3" data-height="100%">
                        <div class="row gx-3">
                            @foreach ($datauser as $key=>$user)
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3">
                                <div class="card h-100">
                                    <div class="card-body h-100 p-1">
                                        <div class="pos-product">
                                            @if ($user->img === null)
                                            <div class="img" style="background-image: url(../../user/male.png);min-height: 14rem;" ></div>
                                            @else
                                            <div class="img" style="background-image: url(../../user/{{ $user->img }});min-height: 14rem;" ></div>
                                            @endif
                                            <div class="info">
                                                <div class="title text-truncate" style="font-size: 12px;">{{ $user->name }}</div>
                                                <div class="desc text-theme" style="font-size: 10px;margin-bottom: 2px;">{{ $user->nik }}</div>
                                                <div class="desc text-truncate" style="font-size: 10px;margin-bottom: 2px;">{{ $user->role }}</div>

                                                @if (auth::user()->role === "SUPER-ADMIN") 
                                                <div class="mb-2" align="right">
                                                <span class="text-center"><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit('{{ $user->id }}','{{ $user->name }}','{{ $user->tlp }}','{{ $user->domisili }}','{{ $user->gender }}','{{ $user->img }}')"><i class="fas fa-edit"> </i></a><a class="text-default" style="font-weight: bold;"></a>  <a class="text-danger" style="cursor: pointer;" onclick="openmodaldeleteaccount('{{ $user->id }}','{{ $user->nik }}')"><i class="fas fa-times-circle"></i></a></span>
                                                </div>
                                                    <div>
                                                        <?php 
                                                        foreach ($getuser as $key=>$email){
                                                            if (($email->email === $user->nik)) {
                                                                $status = "1"; 
                                                                break;
                                                            }  else {
                                                                $status = "0"; 
                                                            }
                                                        }
                                                        ?> 

                                                        @if ($status === "1") 
                                                            <a class="btn btn-danger btn-sm d-block" style="cursor: pointer;" onclick="openmodaldelete('{{ $user->id }}','{{ $user->nik }}')"><i class="fa fa-times fa-fw"></i> Disable</a>
                                                        @else
                                                            <a class="btn btn-success btn-sm d-block" style="cursor: pointer;" onclick="openmodalcreate('{{ $user->id }}','{{ $user->nik }}','{{ $user->name }}','{{ $user->role }}','{{ $user->img }}')"><i class="fa fa-check fa-fw"></i> Active</a>
                                                        @endif
                                                    </div>
                                                @elseif (auth::user()->role === "STAFF-ASSET")
                                                <div class="mb-2" align="right">
                                                    <span class="text-center"><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit('{{ $user->id }}','{{ $user->name }}','{{ $user->tlp }}','{{ $user->domisili }}','{{ $user->gender }}','{{ $user->img }}')"><i class="fas fa-edit"> </i></a><a class="text-default" style="font-weight: bold;"></a>  <a class="text-danger" style="cursor: pointer;" onclick="openmodaldeleteaccount('{{ $user->id }}','{{ $user->nik }}')"><i class="fas fa-times-circle"></i></a></span>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-arrow">
                                        <div class="card-arrow-top-left"></div>
                                        <div class="card-arrow-top-right"></div>
                                        <div class="card-arrow-bottom-left"></div>
                                        <div class="card-arrow-bottom-right"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            {{-- {{ $datauser->links(0) }} --}}
                            <ul class="pagination mb-0">
                                @if ($datauser->onFirstPage())
                                <li class="page-item disabled"><a class="page-link" href="{{ $datauser->previousPageUrl() }}">Previous</a></li>
                                @else
                                <li class="page-item"><a class="page-link" href="{{ $datauser->previousPageUrl() }}">Previous</a></li>
                                @endif

                                <?php 
                                $i= 1;
                                $now = $datauser->lastPage();
                                ?>
                                @while ($i <= $now)
                                <?php
                                    if ($datauser->currentPage() === $i) {
                                       $status="active";
                                    } else{
                                        $status="";
                                    }
                                ?>
                                @if($i >= $datauser->currentPage() - 2 && $i <= $datauser->currentPage() + 2)
                                <li class="page-item {{ $status }}"><a class="page-link" href="<?php echo $datauser->url( $i ) ?>">{{  $i  }}</a></li>
                                @endif
                                <?php $i++; ?>
                                @endwhile

                                @if ($datauser->onLastPage())
                                <li class="page-item disabled"><a class="page-link" href="{{ $datauser->nextPageUrl() }}">Next</a></li>
                                @else
                                <li class="page-item"><a class="page-link" href="{{ $datauser->nextPageUrl() }}">Next</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-arrow">
                <div class="card-arrow-top-left"></div>
                <div class="card-arrow-top-right"></div>
                <div class="card-arrow-bottom-left"></div>
                <div class="card-arrow-bottom-right"></div>
            </div>
        </div>
    </div>
<!-- ================== END page-js ================== -->
@include('employee.delete')
@include('employee.delete_account')
@include('employee.create')
@include('employee.edit')

<script>
    // edit
    function openmodalcreate(id,nik,name,role,img) {
        $('#modalcreate').modal('show');
        document.getElementById('id').value = id;
        document.getElementById('email').value = nik;
        document.getElementById('name').value = name;
        document.getElementById('roles').value = role;
        document.getElementById('imgs').value = img;
    }

    function submitformcreate() {
        document.getElementById('form_create').action = "/register";
        document.getElementById("form_create").submit();
    }

    function openmodaledit(id,name,tlp,domisili,gender,img) {
        $('#modaledit').modal('show');
        document.getElementById('e_id').value = id;
        document.getElementById('e_name').value = name;
        document.getElementById('e_tlp').value = tlp;
        document.getElementById('e_domisili').value = domisili;

        if (img == "") {
            document.getElementById("e_img").src = '../../user/male.png';
        } else {
            document.getElementById("e_img").src = '../../user/' + img;
        }

        document.getElementById("e_genderdefault").innerHTML = "DEFAULT : " + gender;
        document.getElementById("e_genderdefault").value = gender;
    }

    function submitformedit() {
        var value = document.getElementById('e_id').value;
        document.getElementById('form_edit').action = "../employees/editact/"+value;
        document.getElementById("form_edit").submit();
    }

      // delete
      function openmodaldeleteaccount(id,nik) {
        $('#modaldeleteaccount').modal('show');
        document.getElementById('delacc_id').value = id;
        document.getElementById('delacc_nik').value = nik;
    }

    function submitformdeleteaccount() {
        var value = document.getElementById('delacc_id').value;
        document.getElementById('form_deleteaccount').action = "../employees/destroy_employee/"+value;
        document.getElementById("form_deleteaccount").submit();
    }

     // delete
    function openmodaldelete(id,nik) {
        $('#modaldelete').modal('show');
        document.getElementById('del_id').value = id;
        document.getElementById('del_nik').value = nik;
    }

    function submitformdelete() {
        var value = document.getElementById('del_id').value;
        document.getElementById('form_delete').action = "../employees/destroy/"+value;
        document.getElementById("form_delete").submit();
    }
</script>


@endsection

