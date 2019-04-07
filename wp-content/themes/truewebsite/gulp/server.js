var StaticServer = require('static-server');
var server = new StaticServer({
  rootPath: './project/',
  port: 1337              
});

server.start(function () {
  console.log('Server Started At Port ', server.port);
});