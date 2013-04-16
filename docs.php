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
                <li><a href="#_ws_notifications">Notifications</a></li>
                <li><a href="#_ws_send">.send()</a></li>
                <li><a href="#_ws_broadcast">.broadcast()</a></li>
                <li><a href="#_ws_query">.query()</a></li>
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

//connect to insto
i = new InstoClient('API_KEY', userData, userQuery, {
	
  onConnect: function(data) { ... },
  onConnectedUsers: function(data) { ... },
  onNotification: function(data) { ... },
  onQuery: function(data) { ... },
  onUserConnect: function(data) { ... },
  onUserDisconnect: function(data) { ... }
	
});
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
                
                
                <h4>Callback options</h4>
                <p>There are a number of options available to help you deal with any incoming notifications, and they are accessible via the callback options parameter. These are all functions that accept one parameter which contains the notification data.</p>
                <ul>
                	<li><b>onConnect:</b> this is fired when you connect to the server and contains your unique ID</li>
                	<li><b>onConnectedUsers:</b> this contains all of the other connected users that match your userQuery</li>
                	<li><b>onNotification:</b> fired whenever a notification is received from another connected user</li>
                	<li><b>onQuery:</b> contains the results of a query API call</li>
                	<li><b>onUserConnect:</b> fired whenever a new user connects, and contains their userData</li>
                	<li><b>onUserDisconnect:</b> fired whenever a new user disconnects, and contains their userData</li>
                	
                </ul>

              </div>
              
              <div>
                <h1>Websocket API</h1>
                <p>The Websocket API is used to send and receive notifications between connected clients in real-time.</p>
                
                <h3 id='_ws_notifications'>Notifications</h3>
                <p>Notifications can be sent and received by any connected InstoClient, and when they are received they are passed to the appropriate callback function for the developer to handle as required.</p>
                <p>There are six types of notification, with the related callback shown below.</p>
								
								<h4>onConnect</h4>
								<p>Fired when an InstoClient has successfully connected to the Insto server</p>
<pre class='prettyprint'>
{
  _id: "kjghdfgosdkfj-65"
}
</pre>

								<h4>onConnectedUsers</h4>
								<p>Fired after connection if any currently connected Insto clients match the supplied userQuery. Provides an array of matching clients userData objects.</p>
<pre class='prettyprint'>
{
  users: [
    {
      _id: "hhgjjudnySDF-34",
      name: "John Smith",
      department: "sales"
    },
    {
      _id: "jhdfsSDFsh-34",
      name: "Fiona Clarke",
      department: "finance"
    } 
  ]
}
</pre>
								
								<h4>onNotification</h4>
								<p>Fired every time an InstoClient receives a notification from another InstoClient, either via a broadcast message or matching a userQuery on a direct message.</p>
<pre class='prettyprint'>
insto.send({department: "sales"}, { foo: "Bar" }); // send notification to all users in the sales department

{
  _id: "ksjhdfjkksdf-45", //the unique ID of the sender
  foo: "bar"
}

insto.broadcast({ hello: "World" }); //send notification to ALL connected users

{
  _id: "ksjhdfjkksdf-45", //the unique ID of the sender
  hello: "World"
}
</pre>
								
								<h4>onUserConnect</h4>
								<p>Fired when another Insto client connects to the server and matches the supplied userQuery. Provides this clients userData object.</p>
<pre class='prettyprint'>
{
  _id: "hhgjjudnySDF-34",
  name: "John Smith",
  department: "sales"
}
</pre>

								<h4>onUserDisconnect</h4>
								<p>Fired when another Insto client disconnects from the server and matches the supplied userQuery. Provides this clients userData object.</p>
<pre class='prettyprint'>
{
  _id: "hhgjjudnySDF-34",
  name: "John Smith",
  department: "sales"
}
</pre>

								<h4>Query</h4>
								<p>Fired as a response from the query method (insto.query()). Provides an array of other connected users that match the supplied query.</p>
<pre class='prettyprint'>
insto.query({department: "sales"}); // find all connected users in the sales department

{
  users: [
    {
      _id: "hhgjjudnySDF-34",
      name: "John Smith",
      department: "sales"
    },
    {
      _id: "jhdfsSDFsh-34",
      name: "Fiona Clarke",
      department: "sales"
    } 
  ]
}
</pre>
								
								<h1 id='_ws_send'>Methods</h1>
								             
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
