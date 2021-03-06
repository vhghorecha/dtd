</div>
<!-- /#wrapper -->
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
        $('select:not(.notselect)').select2();
    });
</script>

<script type="text/javascript">
    // When the document is ready
    $(document).ready(function() {
        $('table.dttable').DataTable({
            "sDom": '<"top">rt<"bottom"><"clear">',
            "responsive" : true,
            "bSort": false,
        });
    });
</script>


<script>
    $(document).ready(function(){
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
            //$('<button class="btn btn-primary pull-right">Clear Search</button>').click( function () {$('input').val('');fnResetAllFilters();}).insertBefore( 'div.dataTables_wrapper');
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

        <?php
            if($current_page == 'admin')
            {
                ?>
                    $('#msgcount').load('<?php echo site_url("ajax/a_rec_count");?>');
                <?php
            }

            if($current_page == 'customer')
            {
                ?>
                    $('#msgcount').load('<?php echo site_url("ajax/c_rec_count");?>');
                <?php
            }

            if($current_page == 'vendor')
            {
                ?>
                    $('#msgcount').load('<?php echo site_url("ajax/v_rec_count");?>');
                <?php
            }
        ?>

    });
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
</body>
</html>