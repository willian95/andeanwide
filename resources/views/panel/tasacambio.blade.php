@extends('layouts.adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Tasas de cambio</h1>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--7">
    <div class="row">

        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">

                <div class="card-body">
                    <form method="POST" action="{{ route('panel.tasacambio.post') }}">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">Edición de % de transacción</h6>
                        <div class="pl-lg-4">
                            <div class="col-md-12 text-center bg-gray mb-5 mt-3">
                                <h2> % de tasas prioridad baja</h2>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="CLPtoCOPDay2">% Desde Chile a
                                                Colombia <i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="CLPtoCOPDay2" name="CLPtoCOPDay2"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->CLPtoCOPdias2}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="CLPtoEURDay2">% Desde Chile a
                                                Europa <i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="CLPtoEURDay2" name="CLPtoEURDay2"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->CLPtoEURdias2}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="CLPtoVESDay2">% Desde Chile a
                                                Venezuela <i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="CLPtoVESDay2" name="CLPtoVESDay2"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->CLPtoVESdias2}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="COPtoCLPDay2">% Desde Colombia a
                                                Chile <i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="COPtoCLPDay2" name="COPtoCLPDay2"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->COPtoCLPdias2}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="COPtoEURDay2">% Desde Colombia a
                                                Europa<i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="COPtoEURDay2" name="COPtoEURDay2"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->COPtoEURdias2}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="COPtoVESDay2">% Desde Colombia a
                                                Venezuela<i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="COPtoVESDay2" name="COPtoVESDay2"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->COPtoVESdias2}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="EURtoCLPDay2">% Desde Europa a
                                                Chile <i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="EURtoCLPDay2" name="EURtoCLPDay2"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->EURtoCLPdias2}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="EURtoCOPDay2">% Desde Europa a
                                                Colombia <i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="EURtoCOPDay2" name="EURtoCOPDay2"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->EURtoCOPdias2}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="EURtoVESDay2">% Desde Europa a
                                                Venezuela <i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="EURtoVESDay2" name="EURtoVESDay2"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->EURtoVESdias2}}">
                                        </div>
                                    </div>
                                </div>




                                <div class="col-md-12 text-center bg-gray mb-5 mt-3">
                                    <h2> % de tasas prioridad Alta</h2>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="CLPtoCOPDay1">% Desde Chile a
                                                Colombia <i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="CLPtoCOPDay1" name="CLPtoCOPDay1"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->CLPtoCOPdias1}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="CLPtoEURDay1">% Desde Chile a
                                                Europa <i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="CLPtoEURDay1" name="CLPtoEURDay1"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->CLPtoEURdias1}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="CLPtoVESDay1">% Desde Chile a
                                                Venezuela <i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="CLPtoVESDay1" name="CLPtoVESDay1"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->CLPtoVESdias1}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="COPtoCLPDay1">% Desde Colombia a
                                                Chile <i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="COPtoCLPDay1" name="COPtoCLPDay1"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->COPtoCLPdias1}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="COPtoEURDay1">% Desde Colombia a
                                                Europa<i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="COPtoEURDay1" name="COPtoEURDay1"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->COPtoEURdias1}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="COPtoVESDay1">% Desde Colombia a
                                                Venezuela<i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="COPtoVESDay1" name="COPtoVESDay1"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->COPtoVESdias1}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="EURtoCLPDay1">% Desde Europa a
                                                Chile <i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="EURtoCLPDay1" name="EURtoCLPDay1"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->EURtoCLPdias1}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="EURtoCOPDay1">% Desde Europa a
                                                Colombia <i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="EURtoCOPDay1" name="EURtoCOPDay1"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->EURtoCOPdias1}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="EURtoVESDay1">% Desde Europa a
                                                Venezuela <i class="fa fa-info-circle"></i></label>
                                            <input type="text" id="EURtoVESDay1" name="EURtoVESDay1"
                                                class="form-control form-control-alternative"
                                                value="{{$tasas->EURtoVESdias1}}">
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>


                        <div class="pl-lg-4">
                        </div>

                        <!-- Description -->


                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
