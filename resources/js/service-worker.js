importScripts("https://js.pusher.com/beams/service-worker.js");
<script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>


  const beamsClient = new PusherPushNotifications.Client({
    instanceId: 'ace81002-f2ed-4200-88a7-aab5323e5ac1',
  });

  beamsClient.start()
    .then(() => beamsClient.addDeviceInterest('hello'))
    .then(() => console.log('Successfully registered and subscribed!'))
    .catch(console.error);
