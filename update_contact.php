<?php
$selectClient = "<select name='client_id' id='client_id' class='form-control'><option value=''>Select CLient to Link To</option>";
$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"http://localhost/business-casual/api/controller/Select_all_clients.php");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$marital_status = curl_exec($ch);
	curl_close ($ch);
    
	$recordClientName = json_decode($marital_status,true);
	if(  (is_array($recordClientName) && sizeof($recordClientName)>0))
	{
		$numberOfClients = sizeof($recordClientName);
		
		for($i=0; $i<$numberOfClients; $i++)
		{
			$sid = $recordClientName[$i]['id'];
			$Client_name = $recordClientName[$i]['Client_name'];
			$ClientCode = $recordClientName[$i]['ClientCode'];
			$selectClient .= "<option value='$sid'>$Client_name($ClientCode) </option>";
		}
		$selectClient .= "</select>";
	}

//contcts
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"http://localhost/business-casual/api/controller/select_contact_by_id.php");
	curl_setopt($ch, CURLOPT_POSTFIELDS, "id=".$_GET["id"]);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$clients = curl_exec($ch);
	curl_close ($ch);
    
	$recordClientNames = json_decode($clients,true);
    $information  ="";
    $information .= "<p>==============================================================</p>";
	if(  (is_array($recordClientNames) && sizeof($recordClientNames)>0))
	{
		$numberOfClients = sizeof($recordClientNames);
		
		for($i=0; $i<$numberOfClients; $i++)
		{
            //var_dump($recordClientNames[$i]['Name']);
           // $information .= "<div>";
            $name = $recordClientNames[$i]['Name'];
            $Surname =$recordClientNames[$i]['Surname'] ;
            $email =$recordClientNames[$i]['email'] ;

        
           // $information .= "<div>";

		
		}
         //die();

	
	}else{
        $information .= "<p>No Contacts Found</p>";
        $information .= "<p>==============================================================</p>";
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Contact - Business Casual - Start Bootstrap Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="brand">Business Casual</div>
    <div class="address-bar">3481 Melrose Place | Beverly Hills, CA 90210 | 123.456.7890</div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.php">Business Casual</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="about.php">About</a>
                    </li>
                    <li>
                        <a href="blog.php">Blog</a>
                    </li>
                    <li>
                        <a href="Clients.php">Client(s)</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact(s)</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Update
                        <strong>Contact</strong>
                    </h2>
                    <hr>
                    <p>Please Fill in your details below</p>
                    <form role="form" id="form" action=""  method="POST">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Name</label>
                                <input type="text" name="name" value="<?php echo $name;?>" class="form-control">
                                <input type="hidden" name="id" value="<?php echo $_GET["id"];?>" class="form-control">
                            </div>
                                 <div class="form-group col-lg-4">
                                <label>Surname</label>
                                <input type="text" name="sname" value="<?php echo $Surname;?>" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Email Address</label>
                                <input type="email"  name="email" value="<?php echo $email;?>" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <?php echo $selectClient?>
                            </div>
                            <div class="clearfix"></div>
                            
                            <div class="form-group col-lg-12">
                                <input type="hidden" name="save" value="contact">
                                <button type="submit" class="btn btn-default">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
    <div class="modal hide" id="addBookDialog">
        <div class="modal-header">
           <button class="close" data-dismiss="modal">×</button>
           <h3>Modal header</h3>
         </div>
           <div class="modal-body">
               <p>some content</p>
               <input type="text" name="bookId" id="bookId" value=""/>
           </div>
       </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
<script>
    $(document).ready(function (e) {
        $("#form").on('submit',(function(e) {
      
        $.ajax({
                url: "api/controller/update_contacts.php",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
                cache: false,
        processData:false,
        beforeSend : function()
        {
           
        },
        success: function(data)
            {
            if(data=='invalid')
            {
            // invalid file format.
            // $("#err").html("Invalid File !").fadeIn();
            }
            else
            {
            // view uploaded file.
            // $("#preview").html(data).fadeIn();
            // $("#form")[0].reset(); 
              console.log(data);
            }
            },
            error: function(e) 
            {
                console.log(e);
            }          
            });
        }));

        //get all contacts
        $.ajax({
                url: "api/controller/Select_all_users.php",
                type: "GET",
                contentType: false,
                        cache: false,
                processData:false,
                beforeSend : function()
                {
                
                },
                success: function(data)
                    {
                    if(data=='invalid')
                    {
                    // invalid file format.
                    // $("#err").html("Invalid File !").fadeIn();
                    }
                    else
                    {
                    // view uploaded file.
                    // $("#preview").html(data).fadeIn();
                    // $("#form")[0].reset(); 
                    console.log(data);
                    
                       var trHTML = '';
                        $.each(data, function (i, item) {
                            trHTML += '<tr><td>' + item.Name + ' ' + item.Surname + '</td><td>' + item.email + '</td>  <td> <a data-toggle="modal" data-id="ISBN564541" title="Add this item" class="open-AddBookDialog btn btn-primary" href="#addBookDialog">edit</a> <button type="button" class="btn btn-success">unlink</button> <button type="button" class="btn btn-danger">delete</button></td></tr>';
                        });
                        $('#contacts_table').append(trHTML);
                    }
                    },
                    error: function(e) 
                    {
                        console.log(e);
                    }          
            });
            $(document).on("click", ".open-AddBookDialog", function () {
                var myBookId = $(this).data('id');
                $(".modal-body #bookId").val( myBookId );
                // As pointed out in comments, 
                // it is unnecessary to have to manually call the modal.
                 $('#addBookDialog').modal('show');
            });
});
</script>
</html>
