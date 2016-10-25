var React = require('react');

var Products = React.createClass({
  render: function() {
    return ( <ul>
              <li>{this.props.data}</li>
            </ul>
    );
  }
});

module.exports = Products;
