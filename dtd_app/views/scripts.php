
<!-- jQuery -->
<script src="<?=RES_URL;?>js/jquery-1.11.1.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?=RES_URL;?>js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?=RES_URL;?>js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?=RES_URL;?>js/sb-admin-2.js"></script>
<script src="<?=RES_URL;?>js/bootstrap-datepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?=RES_URL;?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?=RES_URL;?>js/dataTables.bootstrap.js"></script>
<script type="text/javascript" language="javascript" src="<?=RES_URL;?>js/dataTables.responsive.js"></script>
<script type="text/javascript" language="javascript" src="<?=RES_URL;?>js/jquery.columnFilter.js"></script>
<script type="text/javascript" language="javascript" src="<?=RES_URL;?>js/select2.min.js"></script>
<script type="text/javascript">
    // When the document is ready
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy"
        });
        $('.tdatepicker').datepicker({
            format: "M-dd"
        });
        $('.ydatepicker').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
        $('.mdatepicker').datepicker({
            format:"yyyy-mm",
            viewMode: "months",
            minViewMode: "months"
        });
        $('.datepicker, .tdatepicker, .ydatepicker, .mdatepicker').on('changeDate', function(ev){
            $(this).datepicker('hide');
        });
        $('select').select2();
    });
    var txtsearch = '<input type="text" placeholder="Search" style="width:100%" />';
    var datesearch = '<input type="text" placeholder="Search" style="width:100%" class="tdatepicker" />';
</script>

<script type="text/javascript">
    // When the document is ready
    $(document).ready(function() {
        $('table.dttable').DataTable({
            "sDom": '<"top">rt<"bottom"><"clear">',
            "responsive" : true
        });
    });
</script>


<script>
    if(typeof table !== 'undefined'){
        table.DataTable().columns().every( function () {
            var that = this;
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
        function fnResetAllFilters() {
            var oSettings = table.fnSettings();
            for (iCol = 0; iCol < oSettings.aoPreSearchCols.length; iCol++) {
                oSettings.aoPreSearchCols[iCol].sSearch = '';
            }
            table.fnDraw();
        }
        $('<button class="btn btn-primary pull-right">Clear Search</button>').click( function () {$('input').val('');fnResetAllFilters();}).insertBefore( 'div.dataTables_wrapper');
    }

    if(typeof table2 !== 'undefined'){
        table2.DataTable().columns().every( function () {
            var that = this;
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
        function fnResetAllFilters() {
            var oSettings = table2.fnSettings();
            for (iCol = 0; iCol < oSettings.aoPreSearchCols.length; iCol++) {
                oSettings.aoPreSearchCols[iCol].sSearch = '';
            }
            table2.fnDraw();
        }
    }
    $(document)
        .ajaxStart(function(){
            $(".dhlmodal").show();
        })
        .ajaxStop(function(){
            $(".dhlmodal").hide();
        }).ajaxError(function( event, jqxhr, settings, thrownError ) {
            $(".dhlcenter").hide();
            $("ajaxerror").html(thrownError).show();
        });
</script>