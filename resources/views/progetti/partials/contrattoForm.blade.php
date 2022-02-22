<style>
    .vertical-container {
        position: relative;
        height: 14rem;
        float: none;
        display: table-cell;
        vertical-align: top;
    }

    .pad {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .table-row {
        display: table;
        width: 100%;
    }
</style>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Form Attività</h3>
    </div>
    <!-- /.box-header -->

    <!-- /.box-body -->
    <div class="box-body">

        <div class="table-row">
            <div class="col-md-2 vertical-container">
                <div class="btn-group-vertical pad">
                    <button id="btn-up" onclick="moveUp($('#parent_id').val(),{!! $progetto->id !!})" type="button"
                            class="btn btn-default">
                        <span class="glyphicon glyphicon-chevron-up"></span></button>
                    <button id="btn-down" onclick="moveDown($('#parent_id').val(),{!! $progetto->id !!})"
                            type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-chevron-down"></span></button>
                </div>
            </div>
            <div class="col-md-10">
                </br>

                <div class="form-group">
                    <label>Descrizione</label>
                    {!! Form::text('descrizione', null,['class'=>'form-control', 'id'=>'descrizione']) !!}
                    {!! Form::hidden('parent_id', null,['class'=>'form-control', 'id'=>'parent_id']) !!}
                    {!! Form::hidden('progetto_id', $progetto->id,['class'=>'form-control', 'id'=>'progetto_id']) !!}
                    {!! Form::hidden('selected', null,['class'=>'form-control', 'id'=>'selected']) !!}
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <button id="btn-submit" type="submit" class="btn btn-primary">Invia</button>
    </div>

</div>