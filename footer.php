<!-- CDN of bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- CDN of fond awsome -->
<script src="https://kit.fontawesome.com/0589b5e23e.js" crossorigin="anonymous"></script>
<!-- CDN of Swal Alert js -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- CDN of jquery -->
<script
			src="https://code.jquery.com/jquery-3.6.3.min.js"
			integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
			crossorigin="anonymous"
		></script>
<script>
            $(document).ready(()=>{
                $('#qus_div').hide();
                $('#pass_div').hide();

                $('#em').keyup(()=>{
                    let email_search=$('#em').val()
                    // console.log(email_search);
                    $.ajax({
                    url:'live_search.php',
                    method:'POST',
                    data:{email:email_search},
                    success:function(data){
                        console.log(data);
                        if(data!=0) {
                             $('#mail_sts').html("<p class='text-success fw-bold'>success</p>");
                             $('#qus_div').show();
                             var x=JSON.parse(data);
                             $('#qus').html(x.squs);
                             var a=x.sans;
                             $('#ans').keyup(()=>{
                                let ans=$('#ans').val();
                                if(ans==a){
                                    $('#qus_sts').html("<p class='text-success fw-bold'>success</p>");
                                    $('#pass_div').show();

                                }
                                else{
                                    $('#qus_sts').html("<p class='text-danger fw-bold'>fail</p>");

                                }
                             })
                        }
                         else{
                            $('#mail_sts').html("<p class='text-danger fw-bold'>fail</p>");
                         }
                        
                    }
                
                })
                })

            });
         
        </script>
</body>
</html>
