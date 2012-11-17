<div class='span8'>
  <table class='table table-striped table-bordered table-hover'>
    <tr>
      <th>#</th>
      <th>Hostname</th>
      <th>API key</th>
    </tr>
    <?
    foreach ($_SESSION['user']['docs'] as $k => $doc) {
    ?>
      <tr>
        <td><?=($k+1);?></td>
        <td><?=$doc['hostname'];?></td>
        <td><?=$doc['_id'];?></td>
      </tr>
    <?
    }
    ?>
  </table>
</div>

<div class='span4'>
  <h3>API Keys</h3>
  <p>Quick reference for all of your API keys.</p>
  <p>Remember that you can only use an API key with the associated hostname!</p>
</div> 
