<?
  $docsActive = true;
  $title = "Docs";
  require_once('includes/header.php');
?>

    <!-- demos -->
    <div class="row-fluid section section-last" id="features">
      <div class="container"> 

        <div class="explain">
          <h2>Documentation</h2>
          <p class="intro">How to get going with Insto...</p>
          <div class="row-fluid"> 
            
            <div class="span3 hidden-tablet hidden-phone">
              <ul class="nav nav-list affix docsidebar" id='sidebar'>
                <li class="nav-header">Getting Started</li>
                <li><a href="#_signup">Signing up</a></li>
                <li><a href="#_setup">Initial Setup</a></li>
                <li><a href="#_connecting">Connecting to Insto</a></li>
                <li class="nav-header">Websocket API</li>
                <li><a href="#_ws_send">.send()</a></li>
                <li><a href="#_ws_broadcast">.broadcast()</a></li>
                <li><a href="#_ws_query">.query()</a></li>
                <li><a href="#_ws_connected">Connected Users</a></li>
                <li class="nav-header">RESTful API</li>
                <li><a href="#_rf_send">Send</a></li>
                <li><a href="#_rf_broadcast">Broadcast</a></li>
                <li><a href="#_rf_query">Query</a></li>
              </ul>
            </div>
            
            <div class='span9'>
              <div id='_signup'>
                <h1>Getting Started</h1>
                <h3>Signing up</h3>
                <p>To be able to do anything with Insto, you need to <a href='/signup'>sign-up</a>. Signing up will register you with Insto, creating an API key for you to use in your applications.</p>
                <p>API keys are tied to the host that you supply, so make sure you enter the correct one!</p>
                
                <p>Once you are signed up, you need to <a href='/signin'>sign-in</a> to see your dashboard. From here you will be able to see all of the API keys that are registered against your user. At the current time, only one API key is allowed per email address.</p>
                
                <p>You will also be able to track how many people are connected to Insto via your application, as well as see how many messages you are sending per day. Message totals are updated once per day, and only include messages that your users receive.</p>
                
              </div>
              
              <div id='_setup'>
                <h3>Initial Setup</h3>
                <p>Configuring your application to use Insto is really simple. Just add the Insto Javascript API shown below into the &lt;head&gt; section of your HTML.</p>
                
<pre class='prettyprint'>
&lt;script type="text/javascript" src="http://api.insto.co.uk:3000/lib/client.js"&gt;&lt;/script&gt;
</pre>

                <p>The first line sets up the <a href='http://socket.io'>Socket.IO</a> library, which is used to help make our Websocket implementation backwards compatible, whilst the second line loads the Insto client library, which creates a wrapper around our Websocket API.</p>
                
              </div>
              
              <div id='_connecting'>
                <h3>Connecting to Insto</h3>
                <p>Once all of the necessary libraries are loaded, you need to connect to the Insto server, luckily, this is also really simple.</p>
                
<pre class='prettyprint'>
// user data
var userData = {
  userType: "example"
}

// user query
var userQuery = {
  userType: "example"
}

// callback
var callback = function(data) {
  console.log(data);
}

//connect to insto
i = new InstoClient('API_KEY', userData, userQuery, callback);
</pre>

                <p>Lets quickly run through what the above is doing...</p>
                
                <h4>userData</h4>
                <p>userData is a Javascript object that describes the connecting user. This object is a series of key/value pairs that consist of all of the properties required to be able to identify this user in the future. There is no schema associated with this object and can contain anything you wish, for example, this is also a valid userData object:</p>
<pre class='prettyprint'>
// user data
var userData = {
  id: 123,
  name: Matt,
  age: 23
}
</pre>

                <h4>userQuery</h4>
                <p>userQuery is again a Javascript object that describe the kind of Insto user the connecting user would like to receive information about. This information comes in the form of connect and disconnect notifications.</p>
                <p>Again, there is no schema associated with this object and it can be created in an identical manner to the userData.</p>
                
                
                <h4>callback</h4>
                <p>The callback function will receive all messages that are sent to your InstoClient, and is the key to your implementation. It is a Javascript function that takes one parameter, which contains the received message.</p>
                <p>The received message will take the form of whatever message was sent, and as such it is expected that the application understands the format it will receive the data and the field names that make up the message.</p>
                <p>All received messages will contain a <b>_type</b> property, signalling what type of notification this is.</p>
                <p>All users that are returned via queries or connection/disconnection notifications will contain an <b>_id</b> property, which is the unique ID for this user.</p>
                
<pre class='prettyprint'>
// Example of a notification
{
  _type: "notification",
  _id: "jdshf-8347jdf45",
  message: "this is a test notification",
  sender_name: "Matt"
}
</pre>
								
								<h4>Connection</h4>
								<p>Once connected, a notification with a _type of 'connected' and an _id showing the unique ID for this user will be returned via the callback function.</p>

<pre class='prettyprint'>
// example 'connected' notification
{
  _type: "connected",
  _id: "34534-sdf245fgdfg"
}
</pre>
								
                <h4>InstoClient</h4>
                <p>Finally, we need to combine the above to actually connect to the Insto service.</p>
                <p>The InstoClient class is used to connect, and all received notifications are relayed through it to the callback function supplied.</p>
                
<pre class='prettyprint'>
// connect to insto
i = new InstoClient('API_KEY', userData, userQuery, callback);
</pre>
              </div>
              
              <div id='_ws_send'>
                <h1>Websocket API</h1>
                <h3>.send( userQuery, messageData, sendToSelf )</h3>
                <p>Use the .send() method to send a message via Insto.</p>
                <h4>userQuery</h4>
                <h6>REQUIRED</h6>
                <p>Javascript object that describes the user who will receive the message.</p>
                
                <h4>messageData</h4>
                <h6>REQUIRED</h6>
                <p>Javascript object that will be sent to the receiving users.</p>
                
                <h4>sendToSelf</h4>
                <h6>DEFAULT: false</h6>
                <h6>ACCEPTS: true, false</h6>
                <p>Determine if the sending user will also receive the message, if they match the supplied userQuery.</p>
                
                <h4>Example</h4>
                <p>The below example sends the messageData to all Insto users that have a 'name' property that equals 'Matt',, who will receive a notification of type 'notification'.</p>
<pre class='prettyprint'>
// user query
var userQuery = {
  name: "Matt"
}

// message
var messageData = {
  sendingUser: "Steven",
  message: "This is an example"
}

// send
i.send(userQuery, messagedata, false);
</pre>

              </div>
              <div id='_ws_broadcast'>
                <h3>.broadcast( messageData )</h3>
                <p>Use the .broadcast() method to send a message to all connected clients.</p>
                
                <h4>messageData</h4>
                <h6>REQUIRED</h6>
                <p>Javascript object that will be sent to the receiving users.</p>
                
                <h4>Example</h4>
                <p>The below example sends the messageData to all Insto users, who will receive a notification of type 'notification'.</p>
<pre class='prettyprint'>

// message
var messageData = {
  sendingUser: "Steven",
  message: "This is an example broadcast"
}

// send
i.broadcast(messagedata);
</pre>

              </div>
              <div id='_ws_query'>
                <h3>.query( userQuery )</h3>
                <p>Use the .query() method to find other connected users.</p>
                <h4>userQuery</h4>
                <h6>REQUIRED</h6>
                <p>Javascript object that describes the users to be returned.</p>
                
                <h4>Example</h4>
                <p>The below example will find all other connected users with a name of 'Matt'. These users will be returned via a notification of type 'query'.</p>
<pre class='prettyprint'>
// user query
var userQuery = {
  name: "Matt"
}

// send
i.query(userQuery);
</pre>

              </div>
              
              <div id='_ws_connected'>
                <h3>Connected Users</h3>
                <p>If a userQuery is supplied at the point of connecting to Insto, notifications will be sent to alert the user when another user who matches this userquery connects or disconnects. A similar notification is also sent as soon as this user connects, providing details of all currently connected users who match the supplied userQuery.</p>
                
                <h4>Example</h4>
                <p>This shows a connect notification, when a new user connects:</p>
<pre class='prettyprint'>
{
  userType: "chat",
  name: "Matt",
  _type: "connect",
  _id: "234234-dfg7d6dfg"
}
</pre>

                <p>This shows a disconnect notification, when a user disconnects:</p>
<pre class='prettyprint'>
{
  userType: "chat",
  name: "Matt",
  _type: "disconnect",
  _id: "234234-dfg7d6dfg"
}
</pre>

                <p>This shows all connected users at the point of connection:</p>
<pre class='prettyprint'>
{
  users: [
    {
      userType: "chat",
      name: "Matt",
      _id: "234234-dfg7d6dfg"
    },
    {
      userType: "chat",
      name: "Steven",
      _id: "234234-dfg7d6dfg"
    }
  ],
  _type: "connectedusers"
}
</pre>

              </div>
              <div id='_rf_send'>
                <h1>RESTful API</h1>
                <h3>Send</h3>
                <p>The RESTful API allows messages to be sent to connected users that match a certain parameter, the URL structure is as shown:</p>
<pre class='prettyprint'>
<?=($config['insto_host']?$config['insto_host']:"http://api.insto.co.uk:3000");?>/&lt;API_KEY&gt;/message/to/&lt;PARAMETER&gt;/&lt;VALUE&gt;?param1=value1&amp;paramN=valueN
</pre>

                <p>Responses are in JSON format, consisting of a success boolean parameter.</p>
                
                <h4>Example</h4>
<pre class='prettyprint'>
<?=($config['insto_host']?$config['insto_host']:"http://api.insto.co.uk:3000");?>/&lt;API_KEY&gt;/message/to/userId/1234?message=hi&amp;sender=Matt

{
  success: true
}
</pre>
              </div>
              
              <div id='_rf_broadcast'>
                <h3>Broadcast</h3>
                <p>The RESTful API allows messages to be sent to all connected users.</p>
<pre class='prettyprint'>
<?=($config['insto_host']?$config['insto_host']:"http://api.insto.co.uk:3000");?>/&lt;API_KEY&gt;/message/all?param1=value1&amp;paramN=valueN
</pre>

                <p>Responses are in JSON format, consisting of a success boolean parameter.</p>
                
                <h4>Example</h4>
<pre class='prettyprint'>
<?=($config['insto_host']?$config['insto_host']:"http://api.insto.co.uk:3000");?>/&lt;API_KEY&gt;/message/all?message=hi&amp;sender=Matt

{
  success: true
}
</pre>
              </div>
              
              <div id='_rf_query'>
                <h3>Query</h3>
                <p>The RESTful API allows users to search for connected users.</p>
<pre class='prettyprint'>
<?=($config['insto_host']?$config['insto_host']:"http://api.insto.co.uk:3000");?>/&lt;API_KEY&gt;/query?param1=value1&amp;paramN=valueN
</pre>

                <p>Responses are in JSON format, consisting of a success boolean parameter and an array of matched users.</p>
                
                <h4>Example</h4>
<pre class='prettyprint'>
<?=($config['insto_host']?$config['insto_host']:"http://api.insto.co.uk:3000");?>/&lt;API_KEY&gt;/query?userType=chat

{
  "msg": [
    {
      "userType": "chat",
      "name": "Matt"
    },
    {
      "userType": "chat",
      "name": "Steven"
    },
    {
      "userType": "chat",
      "name": "Dave"
    }
  ],
  "success": true
}
</pre>
              </div>
              
              
              
            </div>

          </div> 
              
        </div>
      </div>
    </div>
<?
  require_once('includes/footer.php');  
?>
