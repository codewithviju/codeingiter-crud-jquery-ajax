<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/app.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-2">
                <h1 class="text-center ">Welcome To User CRUD Page</h1>
                <div class="d-flex items-center justify-center">
                    <input type="text" class="form-control w-80" name="searchVal" id="searchVal" placeholder="Search By UserName, Email and Marks...">
                    <button class="btn btn-primary mx-2 searchVal">Search</button>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary mt-2 insert">Insert User</button>
                </div>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>USERNAME</th>
                            <th>EMAIL</th>
                            <th>MARKS</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody id="results">
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        function getAllUsers(action = null,UserID = null)
        {
            const searchVal = $("#searchVal").val();

            $.ajax({
                url : "<?php echo base_url("Welcome/getAllData") ?>",
                method : "POST",
                data : {action: action,UserID:UserID,searchVal:searchVal},
                success : function(data){
                    $("#results").html(data);
                }
            })
        }

        $(document).ready(function(){
            getAllUsers();
        });

        $(document).on("click",".insert",function(){
            $("#myModalLabel").html("Add User");
            $("#userName").val('');
            $("#email").val('');
            $("#marks").val('');
            $("#myModal").modal("show");
        });

        $(document).on("click",".delete",function(){
           var UserID = $(this).data("id");
           if(UserID)
           {
                getAllUsers("delete",UserID);
           }
        });

        $(document).on("click",".searchVal",function(){
           getAllUsers();
        });

        $(document).on("click",".edit",function(){
           var UserID = $(this).data("id");
           if(UserID)
           {
                setTimeout(function(){
                    $.ajax({
                        url : "<?php echo base_url("Welcome/getByID") ?>",
                        method : "POST",
                        dataType : "JSON",
                        data : {UserID:UserID},
                        success : function(data){
                           $("#myModalLabel").html("Edit User");
                           $("#UserID").val(data.UserID);
                           $("#userName").val(data.Username);
                           $("#email").val(data.Email);
                           $("#marks").val(data.Marks);
                           $("#myModal").modal("show");
                        }
                    })
                },100)
           }
        });

        $(document).on("click",".addUser",function(){
            const UserID   = $("#UserID").val();
            const username = $("#userName").val();
            const email = $("#email").val();
            const marks = $("#marks").val();

            setTimeout(function(){
                $.ajax({
                    url : "<?php echo base_url("Welcome/new") ?>",
                    method : "POST",
                    data : {username:username,email:email,marks:marks,UserID:UserID},
                    dataType : "JSON",
                    success : function(data){
                        getAllUsers();
                        $("#myModal").modal("hide");
                    }
                })
            },100);
        });
    </script>
</body>

</html>




<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="UserID" id="UserID">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group mt-2">
                            <label for="userName">UserName</label>
                            <input type="text" class="form-control" name="userName" id="userName">
                        </div>
                        <div class="form-group mt-2">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group mt-2">
                            <label for="marks">Marks</label>
                            <input type="text" class="form-control" name="marks" id="marks">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary addUser">Save Changes</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->