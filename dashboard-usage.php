<div class='span3'>
  <ul class="nav nav-pills nav-stacked" id='usage-list'>
    <?
    foreach ($_SESSION['user']['docs'] as $k => $doc) {
    ?>
      <li id='usage<?=$k;?>'>
        <a href="Javascript:selectUsage(<?=$k;?>, '<?=$doc['_id'];?>');">
          <p><?=$doc['hostname'];?></p>
          <p><?=$doc['_id'];?></p>
        </a>
      </li>
    <?
    }
    ?>
  </ul>
</div>

<div class='span5' id='usage-info'>
  
  <div class='alert alert-info'>
    <h4>Select an API key/Host from the left.</h4>
  </div>
  
</div>

<div class='span4'>
  <h3>Usage</h3>
  <p>There are currently no usage restrictions for users of our open beta, however this might change!</p>
  <p>Use this page to monitor your usage.</p>
  <p>Usage statistics are updated nightly.</p>
</div> 
