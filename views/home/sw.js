self.addEventListener("push", (event) => {
  const notification = event.data.json();

  // { "title": "Atualização Fluviômetro", "body": "O nível do fluviômetro está em 75%", "url":"/" }
  event.waitUntil(self.registration.showNotification(notification.title, {
    body: notification.body,
    data: {
      notifURL:  `${self.location.origin}/${notification.url}`
    }
  }))
});

self.addEventListener("notificationclick", (event) => {
  event.notification.close();
  
  event.waitUntil(
    clients.matchAll({ type: "window" }).then((clientsArr) => {
      // If a Window tab matching the targeted URL already exists, focus that;
      const hadWindowToFocus = clientsArr.some((windowClient) =>
        windowClient.url === event.notification.data.notifURL
          ? (windowClient.focus(), true)
          : false,
      );
      // Otherwise, open a new tab to the applicable URL and focus it.
      if (!hadWindowToFocus)
        clients
          .openWindow(event.notification.data.notifURL)
          .then((windowClient) => (windowClient ? windowClient.focus() : null));
    })
  )
});