const electron = require('electron')
// Module to control application life.
const app = electron.app
// Module for mennu
const Menu = electron.Menu
// Module to create native browser window.
const BrowserWindow = electron.BrowserWindow

const path = require('path')
const url = require('url')

app.on('ready', () => {
  if (process.platform === 'darwin') {
    var template = [{
      label: 'FromScratch',
      submenu: [{
        label: 'Quit',
        accelerator: 'CmdOrCtrl+Q',
        click: function() { app.quit(); }
      }]
    }, {
      label: 'Edit',
      submenu: [{
        label: 'Undo',
        accelerator: 'CmdOrCtrl+Z',
        selector: 'undo:'
      }, {
        label: 'Redo',
        accelerator: 'Shift+CmdOrCtrl+Z',
        selector: 'redo:'
      }, {
        type: 'separator'
      }, {
        label: 'Cut',
        accelerator: 'CmdOrCtrl+X',
        selector: 'cut:'
      }, {
        label: 'Copy',
        accelerator: 'CmdOrCtrl+C',
        selector: 'copy:'
      }, {
        label: 'Paste',
        accelerator: 'CmdOrCtrl+V',
        selector: 'paste:'
      }, {
        label: 'Select All',
        accelerator: 'CmdOrCtrl+A',
        selector: 'selectAll:'
      }]
    }];
    var osxMenu = Menu.buildFromTemplate(template);
    Menu.setApplicationMenu(osxMenu);
  }
})

const PHPServer = require('php-server-manager');

let server
  if (process.platform === 'win32') {

server = new PHPServer({
    php: `${__dirname}/php/php.exe`,
    port: 5555,
    directory: __dirname,
    directives: {
        display_errors: 1,
        expose_php: 1
    }
    });
  } else {

server = new PHPServer({
  
    port: 5555,
    directory: __dirname,
    directives: {
        display_errors: 1,
        expose_php: 1
    }
});
};

let mainWindow

function createWindow () {

  server.run();
  mainWindow = new BrowserWindow({width: 800, height: 600})

  mainWindow.loadURL('http://localhost:8000/public/')

/*
mainWindow.loadURL(url.format({
  pathname: path.join(__dirname, 'index.php'),
  protocol: 'file:',
  slashes: true
}))
*/
 const {shell} = require('electron')
 shell.showItemInFolder('fullPath')

  mainWindow.on('closed', function () {
    server.close();
    mainWindow = null;
  })
}

app.on('ready', createWindow) 

app.on('window-all-closed', function () {
  if (process.platform !== 'darwin') {
    server.close();
    app.quit();
  }
})

app.on('activate', function () {
  // On OS X it's common to re-create a window in the app when the
  // dock icon is clicked and there are no other windows open.
  if (mainWindow === null) {
    createWindow()
  }
})
