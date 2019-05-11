const mysql = require('think-model-mysql');

module.exports = {
  handle: mysql,
  database: 'nideshop',
  prefix: 'nideshop_',
  encoding: 'utf8mb4',
  host: 'localhost',
  port: '3306',
  user: 'root',
  password: 'root',
  dateStrings: true
};
