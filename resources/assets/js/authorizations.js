let user = window.App.user;

module.exports = {
  owns(model, prop = 'user_id') {
    return model[prop] === user.id;
  },
  isAdmin() {
    let admins = ['John', 'Jane'];
    return admins.includes(user.name);
  }
};