            </div>
        </div>
        <script src="assets/vendor/modernizr/modernizr.custom.js"></script>
        <script src="assets/vendor/moment/min/moment.min.js"></script>
        <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/bootstrap-datetimepicker.js"></script>
        <script src="assets/vendor/js-storage/js.storage.js"></script>
        <script src="assets/vendor/js-cookie/src/js.cookie.js"></script>
        <script src="assets/vendor/pace/pace.js"></script>
        <script src="assets/vendor/metismenu/dist/metisMenu.js"></script>
        <script src="assets/vendor/switchery-npm/index.js"></script>
        <script src="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="assets/vendor/countup.js/dist/countUp.min.js"></script>
        <script src="assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
        <script src="assets/js/service_scroll/priority-nav-scroller.js"></script>
        <script src="assets/js/service_scroll/main.js"></script>
        <script src="assets/js/global/app.js"></script>
        <script src="assets/js/jquery_date.js"></script>
        <script src="assets/js/nicescroll.js"></script>
        <script src="assets/vendor/moment/min/moment.min.js"></script>
        <script src="assets/vendor/datatables.net/js/jquery.dataTables.js"></script>
        <script src="assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
        <script src="assets/js/jquery.validate.js"></script>
        <script src="assets/js/methods.js"></script>
        <script src="assets/js/login.js"></script>
        <script src="assets/chart.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#table").dataTable();
                $("#product_id").change(function(){
                    $("#pname").val($("#product_id option:selected").attr("data-name"));
                    $("#pcompany_name").val($("#product_id option:selected").attr("data-company"));
                    $("#pmrp").val($("#product_id option:selected").attr("data-mrp"));
                    $("#pqty").val($("#product_id option:selected").attr("data-qty"));
                    $("#quantity").attr("max",$("#product_id option:selected").attr("data-qty"));
                    $("#quantity").val($("#product_id option:selected").attr("data-qty"));
                    $("#stock_qty").val($("#product_id option:selected").attr("data-qty"));
                });
                $("#quantity").keyup(function(){
                    calculate();
                });
                $("#quantity").change(function(){
                    calculate();
                });
                $("#sell_price").change(function(){
                    calculate();
                });

                if ($('#chartjs_pieChart').length) {
                    var ctx = document.getElementById("chartjs_pieChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ["FRONTEND", "BACKEND", "DATABASE"],
                            datasets: [{
                                backgroundColor: [
                                    "#5867C3",
                                    "#1C86BF",
                                    "#28BEBD",
                                    "#FEB38D",
                                    "#EE6E73",
                                    "#EC407A",
                                    "#F8C200"
                                ],
                                data: [cat1, cat2, cat3]
                            }]
                        }
                    });
                }
            });
            function calculate()
            {
                var qty = $("#quantity").val();  
                var price = $("#sell_price").val();  
                $("#total").val(qty*price);
            }
            function remove_row(url)
            {
                if(confirm("Are you sure to remove this record?"))
                {
                    $.ajax({
                        url: url,
                        dataType: "json",
                        success:function(response){
                            if(response.status == 1)
                                window.location.reload();
                        }
                    })
                }
            }
        </script>
    </body>
</html>