<div class='span6'>
    <h3>API Keys</h3>
    <p>Quick reference for all of your API keys.</p>
    <p>Remember that you can only use an API key with the associated hostname! You can supply an additional hostname for your development environment if you wish.</p>
  </div> 

  <div class='span6'>
    <h3>Contact Details</h3>
    <p>You can also change your email address, this is how we may contact you from time to time. At the current time you can only have one API key registered per address.</p>
    <p>You may also change your password by supplying two matching passwords.</p>
  </div> 



</div>

<div class='row-fluid'>
  <div class='span12 mt20'>
    <table class='table table-striped table-bordered table-hover'>
      <tr>
        <th>#</th>
        <th>Hostname</th>
        <th>Dev. Hostname</th>
        <th>API key</th>
        <th>Email</th>
        <th colspan='2'>Password</th>
      </tr>
      <?
      foreach ($_SESSION['user']['docs'] as $k => $doc) {
      ?>
        <tr id='row-<?=$doc['_id'];?>'>
          <td><?=($k+1);?></td>
          <td><span><?=$doc['hostname'];?></span> <input name='hostname' id='hostname' value='<?=$doc['hostname'];?>' class='input-medium hidden' type='text' /></td>
          <td><span><?=$doc['development_hostname'];?></span> <input name='development_hostname' id='development_hostname' value='<?=$doc['development_hostname'];?>' class='input-medium hidden'  type='text' /></td>
          <td><?=$doc['_id'];?></td>
          <td><span><?=$doc['email'];?></span> <input name='email' id='email' value='<?=$doc['email'];?>' class='input-medium hidden' type='text' /></td>
          <td><span>********</span> <input name='password' id='password' value='' class='input-medium hidden' type='password' placeholder='New password' /><input name='confirm' id='confirm' value='' class='input-medium hidden' type='password' placeholder='Confirm...' /></td>
          <td><a id='edit-btn' class='pull-right btn btn-mini btn-success' onclick='editRow("<?=$doc['_id'];?>");'><i class='icon icon-white icon-edit'> </i></a><a id='save-btn' class='pull-right btn btn-mini btn-danger hidden' onclick='saveRow("<?=$doc['_id'];?>");'><i class='icon icon-white icon-file'> </i></a></td>
        </tr>
      <?
      }
      ?>
    </table>
  </div>