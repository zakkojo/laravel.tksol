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
    }
</style>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Modifica Attività</h3>
    </div>
    <!-- /.box-header -->

    <!-- /.box-body -->
    <div class="box-body">
        <div class="table-row">
            <div class="col-md-2 vertical-container">
                <div class="btn-group-vertical pad">
                    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-up"></span></button>
                    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-down"></span></button>
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <label>Ragione Sociale</label>
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                            aria-hidden="true">
                        <option selected="selected">Roberto Spaccini</option>
                        <option>Gianni Graffiedi</option>
                        <option>...</option>
                    </select>
                    <label>Progetto</label>
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                            aria-hidden="true">
                        <option selected="selected">Senior</option>
                        <option>Junior</option>
                    </select>
                    <label>Descrizione</label>
                    {!! Form::text('descrizione', null,['class'=>'form-control', 'id'=>'descrizione']) !!}
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>