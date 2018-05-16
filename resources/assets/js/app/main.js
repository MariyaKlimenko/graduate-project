import app from './app.js';
import createUser from './user/create.js';
import updateUser from './user/update.js';
import allUsers from './user/all.js';
import showUsers from './user/show.js';


$(function () {
    app.init();
    createUser.init();
    allUsers.init();
    updateUser.init();
    showUsers.init();
});