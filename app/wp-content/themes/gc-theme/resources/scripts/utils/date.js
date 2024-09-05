Date.prototype.withoutTime = function () {
  const date = new Date(this);
  date.setHours(0, 0, 0, 0);

  return date;
}

Date.prototype.isToday = function () {
  const today = new Date();
  const date = new Date(this);

  return date.getDate() == today.getDate() &&
    date.getMonth() == today.getMonth() &&
    date.getFullYear() == today.getFullYear()
}
