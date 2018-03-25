import app from './app.js';
import user from './user/user.js';
import allUsers from './user/all.js';


$(function () {
    app.init();
    user.init();
    allUsers.init();
});