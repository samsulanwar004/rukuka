<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
<div>

  <p><a title="Return" href="{{ $return_url }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Users</a></p>

  <div class="panel panel-default">
    <div class="panel-heading">
        <strong><i class="fa fa-circle-o"></i> {{ $page_title }}</strong>
    </div>
    <form method='post' action='{{CRUDBooster::mainpath('edit-save/'.$row->id)}}'>
      {{ csrf_field() }}


      <div class="panel-body" style="padding:20px 0px 0px 0px">
            <div class="box-body" id="parent-form-area">
              <div class="table-responsive">
                <table id="table-detail" class="table table-striped">
                  <tbody>
                  <tr>
                    <td>First Name</td>
                    <td>{{ $row->first_name }}</td>
                  </tr>
                  <tr>
                    <td>Last Name</td>
                    <td>{{ $row->last_name }}</td>
                  </tr>
                  <tr>
                    <td>Date of Birth</td>
                    <td>{{ $row->dob }}</td>
                  </tr>
                  <tr>
                    <td>Gender</td>
                    <td>
                      @php
                          if ($row->gender == 'm') {
                            echo 'Male';
                        } else {
                            echo 'Female';
                        }
                      @endphp
                    </td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td>{{ $row->email}}</td>
                  </tr>
                  <tr>
                    <td>Phone Number</td>
                    <td>{{ $row->phone_number}}</td>
                  </tr>
                  <tr>
                    <td>Created At</td>
                    <td>{{ $row->created_at}}</td>
                  </tr>
                  <tr>
                    <td>Last Login</td>
                    <td>{{ $row->last_login}}</td>
                  </tr>
                  <tr>
                    <td>Email Verification</td>
                    <td>
                      @php
                        if ($row->is_verified == '0') {
                          echo '<span class="label label-warning">Unverified</span>';
                      } else {
                          echo '<span class="label label-success">Verified</span>';
                      }
                      @endphp
                    </td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td>
                      @php
                        if ($row->status == '0') {
                          echo '<span class="label label-warning">Pending</span>';
                      } else if($row->status == '1') {
                          echo '<span class="label label-success">Active</span>';
                      } else {
                          echo '<span class="label label-danger">Unactive</span>';
                      }
                      @endphp</td>
                  </tr>
                  </tbody>
                </table>
              </div>
          </div>
        <div class="box-footer" style="background: #F5F5F5">
          <div class="form-group">
            <div class="col-md-12" align="right">
              <label class="control-label">Email Verification</label>
              <select class="form-control" name="is_verified" style="width: 300px">
                <option value="0" {{ $row->is_verified == 0 ? 'selected' : ''}}>
                  Unverified
                </option>
                <option value="1" {{ $row->is_verified == 1 ? 'selected' : ''}}>
                  Verified
                </option>
              </select>
              <br>
              <label class="control-label">Status</label>
              <select class="form-control" name="status" style="width: 300px">
                <option disabled value="0" {{ $row->status == 0 ? 'selected' : ''}}>
                  Pending
                </option>
                <option value="1" {{ $row->status == 1 ? 'selected' : ''}}>
                  Activate
                </option>
                <option value="2" {{ $row->status == 2 ? 'selected' : ''}}>
                  Unactivate
                </option>
              </select>
            </div>
            <div class="col-sm-12" align="right">
              <br>
              <a href="{{ $return_url }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
              <input type="submit" name="save" class="btn btn-success">
            </div>
          </div>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection