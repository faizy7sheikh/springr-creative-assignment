<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <title>springr creatives</title>
</head>
<body>
   
    <div class="container" style="margin-top:30px">
    
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{$message}}</p>
            </div>
        @endif
        <div class="row mx-2">
            <div class="col-md-8">
                <h1 class="text-center">User Record</h1>
            </div>
            <div class="col-md-4 ">
                <button class="btn  btn-primary pull-right" data-toggle="modal" data-target="#exampleModalCenter">Add User</button>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Avatar</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Experience</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($user)
                        @foreach($user as $users)
                        <tr>
                            <th scope="row"><img src="{{asset($users->image)}}" width="50px" height="50px" alt="" class="rounded-circle" id="avatar"></th>
                            <td>{{$users->name}}</td>
                            <td>{{$users->email}}</td>
                            <td>{{$users->experience}}</td>
                            <td>
                                <form action="{{route('user',$users->id)}}" method="POST">
                                @csrf 
                                @method('DELETE')
                                <button type="submit"  data-id="{{$users->id}}" data-toggle="tooltip" class="btn dbtn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">Add New Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Full Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="staticEmail" placeholder="Full Name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" name="email" value="{{old('email')}}" class="form-control" id="inputPassword" placeholder="E-mail">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Date Of Joining</label>
                        <div class="col-sm-8">
                            <input type="text" name="joining" value="{{old('joining')}}" class="form-control " id="datepicker" placeholder="Joining Date">
                            @error('joining')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Date of Leaving</label>
                        <div class="col-sm-8">
                            <input type="text" name="leaving" value="{{old('leaving')}}" class="form-control " id="datepicker1" placeholder="Leaving Date">
                            @error('leaving')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Upload Avatar</label>
                        <div class="col-sm-8">
                            <input type="file" name="avatar" value="{{old('avatar')}}" class="form-control" id="inputPassword" placeholder="Upload Avatart">
                            @error('avatar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="checkbox" type="checkbox" value="1" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Still Working
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            
            </div>
        </div>
    </div>
    <!-- END MODAL -->
<script>
  $( function() {
    $( "#datepicker" ).datepicker({
        dateFormat: 'yy/mm/dd'
    });
    $("#datepicker1").datepicker({
        dateFormat: 'yy/mm/dd',
        maxDate: 0
    });
  } );
  $(document).ready(function(){
      $(".dbtn").click(function(event){
        if(!confirm('Are you sure you want to delete this?')) {
            return false;
            e.preventDefault();
        }
      })
      setTimeout(function() {
        $(".alert").alert('close');
    }, 1000);
  })
  </script>
  @if (count($errors) > 0)
    <script>
        $( document ).ready(function() {
            $('#exampleModalCenter').modal('show');
        });
    </script>
@endif
</body>
</html>