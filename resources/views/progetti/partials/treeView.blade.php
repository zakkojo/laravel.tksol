<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Filiera Attività</h3>
        <div class="box-tools">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <button id="btn-add" class="btn btn-success " onclick="nuovaAttivita()"><i class="fa fa-plus"></i>&nbsp;
                    Nuova Attività
                </button>
                <button id="btn-rem" class="btn btn-danger " onclick="trashAttivita($('#selected').val())"><i
                            class="fa fa-trash"></i>&nbsp; Elimina Attività
                </button>
            </div>
        </div>

    </div>
    <!-- /.box-header -->

    <!-- /.box-body -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div id="treeview5"></div>
            </div>
        </div>
    </div>
</div>

@section('page_scripts')
    @parent
    <script type="text/javascript">
        var selected_node;
        function initTree(treeData, selectedId) {
            if (typeof(selectedId) === 'undefined') selectedId = {!! $_GET['attivita'] or 0 !!};


            if (typeof(treeData) === 'undefined') var treeData = {!!  $listAttivita !!};
            var alternateData = [{
                text: '<b>{{$progetto->area}} / {{$progetto->nome}}</b>',
                //icon: 'glyphicon glyphicon-certificate',
                //color: 'pink',
                //backColor: 'red',
                href: 'http://www.tesco.com',
                tags: ['available', '0'],
                multiselect: false,
                nodes: treeData
            }];


            $('#treeview5').treeview({
                levels: 99,
                color: "#428bca",
                expandIcon: 'glyphicon glyphicon-chevron-right',
                collapseIcon: 'glyphicon glyphicon-chevron-down',
                //nodeIcon: 'glyphicon glyphicon-bookmark',
                //showTags: true,
                data: alternateData,
                onNodeSelected: function (event, item) {
                    $('#treeview5').treeview('getSelected').forEach(function (node) {
                        if (node.nodeId != item.nodeId) $('#treeview5').treeview('unselectNode', node.nodeId, {silent: true});
                        else {
                            if (node.nodeId != 0) {
                                //CARICO I VALORI DI NODE NELLA FORM DI MODIFICA
                                $('#btn-up').removeClass('disabled');
                                $('#btn-down').removeClass('disabled');
                                $('#btn-rem').removeClass('disabled');
                                $('#btn-submit').removeClass('disabled');
                                $('#descrizione').prop('disabled', false);
                                $('#descrizione').val(node.text);
                                $('[name = "_method"]').val('PATCH');
                                $('#selected').val(node.id);
                                //da modificare per eabilitare sub attivita
                                //$('#parent_id').val(node.id);
                                $('#parent_id').val('0');
                            }
                            else {
                                $('#btn-up').addClass('disabled');
                                $('#btn-down').addClass('disabled');
                                $('#btn-rem').addClass('disabled');
                                $('#btn-submit').addClass('disabled');
                                $('#descrizione').prop('disabled', true);
                                $('#descrizione').val('');
                                $('#parent_id').val('0');
                            }
                        }
                    });
                },
                onNodeUnselected: function (event, item) {
                    if ($('#treeview5').treeview('getSelected').length == 0) {
                        $('#treeview5').treeview('selectNode', item.nodeId)
                    }
                }
            });

            var select = 0;
            $('#treeview5').treeview('getUnselected').forEach(function (node) {
                if (node.id == selectedId)  select = node.nodeId;
            });
            $('#treeview5').treeview('selectNode', select);
        }
        ;

        initTree();

        function nuovaAttivita() {
            $('#btn-up').addClass('disabled');
            $('#btn-down').addClass('disabled');
            $('#btn-rem').addClass('disabled');
            $('#btn-submit').removeClass('disabled');
            $('#descrizione').prop('disabled', false);
            $('#descrizione').val('');
            $('[name = "_method"]').val('POST');
        }

        function trashAttivita(id_attivita) {
            if (typeof(id_attivita) !== 'undefined') {
                if (confirm('Confermi di voler eliminare l\'attivita selezionata?')) { // e tutte le sotto attivita collegate?')) {
                    window.location = "\\attivita\\"+id_attivita+"\\destroy";
                }
            }
        }


        function moveDown(id, progetto_id) {
            var request = $.ajax({
                url: "/ajax/attivita/moveDown",
                type: "get",
                data: {'id': id, 'progetto_id': progetto_id},
                dataType: "JSON"
            }).done(function (data) {
                getDataTree(progetto_id, id)
                console.log(data);
            }).fail(function (jqXHR, textStatus) {
                console.log("Request failed: " + textStatus);
            });
        }
        function moveUp(id, progetto_id) {
            var request = $.ajax({
                url: "/ajax/attivita/moveUp",
                type: "get",
                data: {'id': id, 'progetto_id': progetto_id},
                dataType: "JSON"
            }).done(function (data) {
                getDataTree(progetto_id, id)
                console.log(data);
            }).fail(function (jqXHR, textStatus) {
                console.log("Request failed: " + textStatus);
            });
        }

        function getDataTree(progetto_id, id) {
            var request = $.ajax({
                url: "/ajax/attivita/getDataTree",
                type: "get",
                data: {'progetto_id': progetto_id},
                dataType: "JSON"
            }).done(function (data) {
                initTree(data, id);
            }).fail(function (jqXHR, textStatus) {
                console.log("Request failed: " + textStatus);
            });
        }
    </script>
@endsection