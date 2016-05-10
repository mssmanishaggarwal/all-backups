@extends('layouts.backend')

@section('content')
<form class="form-horizontal">
<div class="box search-box">
<div class="box-header with-border">
                  <h3 class="box-title">Search Filters <span id="spinner-loader-search" style="display: none;">
                                    {{ Html::image('public/images/loader.gif') }}
                                </span></h3>
                  <div class="box-tools pull-right">
                    <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-angle-up"></i></button>
                  </div>
                </div>
                <div class="box-body">
               <div class="form-group">
               						<div class="col-sm-3">
                          <div class="ui-widget">
                                        <input type='text' id='user_name' class="form-control" placeholder="User Name" name="user_name" />
                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                       <input type='text' id='contact_name' class="form-control" placeholder="Contact Name" name="contact_name"/>
                                    </div>
                                     <div class="col-sm-3">
                                        <input type='text' id='contact_email' class="form-control" placeholder="Contact Email" name="contact_email"/>
                                    </div>

                                     <div class="col-sm-3">
                                        <input type='text' id='contact_mobile' class="form-control" placeholder="Mobile no" name="contact_mobile"/>
                                    </div>
                          </div>
                          <div class="form-group">
                                <div class="col-sm-3">
                                          <input type='text' id='hall_name' class="form-control" placeholder="Hall name" name="hall_name" />
                                  </div>
                                <div class="col-sm-3">
                                        <select class="form-control" id="location_id" required="required" name="location_id"
                                        data-bind="value: location_id,
                                        options: myOptions,
                                        optionsText: 'location_name',
                                        optionsValue: 'location_id',
                                        optionsCaption: 'Select Location'">
                                    </select>
                                </div>


                                    <div class="col-sm-3">
                                        <input type='text' id='rental_amount' class="form-control" placeholder="Rental Amount" name="rental_amount"/>
                                    </div>



               <div class="col-sm-3 text-left">

                     <button type="button" class="btn btn-primary btn-flat" data-bind="click: searchClient">Go <span class="fa fa-angle-double-right"></span></button>
                     <button type="button" class="btn btn-default btn-flat" data-bind="click: setRest" ><span class="fa fa-refresh fa-fw"></span> Reset</button>

                  </div>
              </div>
          </div>



                <div class="box-footer">
                    <p> <div id="error_msg"></div></p>
                  </div>
                </div>
            <div class="row">
                <div class="col-sm-6">
                <div class="form-group sorting-panel">
                <label class="col-sm-3">Sort Options</label>
                <div class="col-sm-6" role="sort">
                    <select data-bind="options: availableSorting,optionsCaption: 'Select',optionsText: 'name',
                                optionsValue: 'id'," class="form-control" id="sorting"></select>

                 </div>
                 <div class="col-sm-3">
                 <div class="btn-group">
                    <button  class="btn-default btn btn-flat" data-bind="click: sortClientASC"> <span class="fa fa-sort-alpha-asc text-default"></span></button>
                        <button  class="btn-default  btn btn-flat" data-bind="click: sortClientDESC"><span class="fa fa-sort-alpha-desc text-muted"></span></button>
                    </div></div>


                 </div>
                 </div>
                  <div class="col-sm-6 text-right"><a href="{{ url('/admin/hall') }}" class="btn-dark btn"> <span class="fa fa-plus fa-fw"></span> Add Hall</a></div></div>





                 <div class="box box-default">

                <div class="box-body no-padding">


                   <table class="table table-striped clientlist-table">
                            <thead>
                            <tr>
                                <th>Hall</th>
                                <th>Address</th>
                                <th>User</th>
                                <th>Subscription</th>
                                <th>Amount (AOA)</th>
                                <th>Date</th>
                                <th class="text-right">ACTIONS</th>
                            </tr>
                            </thead>

                            <tbody class="data-values">
							<!--ko foreach: paginatedData -->
                            <tr>
                                <td><span data-bind="text: hall_name"></span></td>
                                <td><span data-bind="text: location_name"></span> ,<span data-bind="text: province_name"></span> ,<span data-bind="text: hall_postcode"></span>
                                </td>
                                <td>
                                <span data-bind="text: first_name"></span> <span data-bind="text: last_name"></span></br>
                                <span data-bind="text: contact_name"></span></br>
                                <span data-bind="text: contact_email"></span></br>
                                <span data-bind="text: contact_mobile"></span>
                                </td>
                                <td></td>
                                <td><span data-bind="text: rental_amount"></span></td>
                                <td>
                                Add Date: <span data-bind="text: created_at"></span></br>
                                Expiry Date: <span ></span>
                                </td>

								<td class="text-right">
                                <div class="btn-group action_div">
                                <button type="button" data-bind="click: $root.btnEdit"  class="btn btn-default "> <span class="fa fa-edit text-default"></span></button>
                                <button type="button" data-bind="click: $root.btnEditimag"  class="btn btn-default "> <span class="fa fa-upload text-default"></span></button>
                                <button type="button" data-bind="click: $root.btnEditaddon"  class="btn btn-default "> <span class="fa fa-puzzle-piece text-default"></span></button>
                                <button type="button" data-bind="click: $root.btnEditaccommodation"  class="btn btn-default "> <span class="fa fa-bed text-default"></span></button>
                                <button type="button" data-bind="click: $root.btnEditsubscription"  class="btn btn-default ">  <span class="fa fa-cube text-default"></span></button>
                                <button type="button" data-bind="click: $root.btnDelete"  class="btn btn-default"><span class="fa fa-trash  text-muted"></span></button>
                                </div>

								</td>


                            </tr>
							<!-- /ko -->
                            </tbody>

                        </table>







     		   </div>
               <div class="box-footer">
             <div class="pagination">
           <span class="spinner-loader">
                                {{ Html::image('public/images/loader.gif') }}
                            </span><span class="text-muted"> {{ trans('messages.page') }}</span>  <span data-bind="text: pageNumber() + 1" ></span> {{ trans('messages.of') }} <span data-bind="text: lastPage"></span></div>
                            <div class="pull-right">
                             <button class="btn btn-default btn-sm btn-prev" data-bind="click: previous, enable: hasPrevious"><span class="fa fa-angle-left"></span></button>
                             <button class="btn btn-default btn-sm btn-next" data-bind="click: next, enable: hasNext" ><span class="fa fa-angle-right"></span></button> </div>
                    <div id="error_msg"></div>

                  </div>
                  </div>

                 </form>






@endsection
@section('script')
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
   <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <script type="text/javascript">
jQuery(document).ready(function($) {
  var baseUrl = $('#baseUrl').val();

  $(function() {
    function log( message ) {
      $( "<div>" ).text( message ).prependTo( "#log" );
      $( "#log" ).scrollTop( 0 );
    }

    $( "#user_name" ).autocomplete({
      source: baseUrl+"/admin/hall/autouser",
      minLength: 2,
      select: function( event, ui ) { //console.log(event);
        log( ui.item ?
          "Selected: " + ui.item.value + " aka " + ui.item.id :
          "Nothing selected, input was " + this.value );
      }
    });
  });
});

   </script>
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
    {{ Html::script('public/js/bootstrap/bootbox.js') }}
    {{ Html::script('public/js/hall_list.js') }}
@endsection
