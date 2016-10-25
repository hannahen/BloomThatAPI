//var products = require('./layout/products.js');
//var React = require('react');

/*console.log('hello');

var ExampleApplication = React.createClass({
      apiKey: '',
      getInitialState: function () {
        return {data: ''};
      },
      componentWillMount: function() {
        this.serverRequest = $.get('http://localhost:8888/API/api/v1/generateAPIKey', {'clientKey': 'products_api'}, function (result) {
          //console.log(result.replace(/"/g,""));
          $.get('/API/api/v1/example', {'clientKey': 'products_api', 'apiKey' : result.replace(/"/g,"") }, function (result2) {
            //console.log(result2);
            this.setState({data: result2});
          });
          return null;
        }.bind(this));
      },
        render: function() {
          return (<div>Hello</div>);
        }
      });

      // Call React.createFactory instead of directly call ExampleApplication({...}) in React.render
      var ExampleApplicationFactory = React.createFactory(ExampleApplication);

      setInterval(function() {
        ReactDOM.render(
          ExampleApplicationFactory(),
          document.getElementById('container')
        );
      }, 50);
*/

var UserGist = React.createClass({
  getInitialState: function() {
    return {
      username: '',
      lastGistUrl: ''
    };
  },

  componentDidMount: function() {
    this.serverRequest = $.get(this.props.source, function (result) {
      var lastGist = result[0];
      this.setState({
        username: lastGist.owner.login,
        lastGistUrl: lastGist.html_url
      });
    }.bind(this));
  },

  componentWillUnmount: function() {
    this.serverRequest.abort();
  },

  render: function() {
    return (
      <div>
        {this.state.username}s last gist is
        <a href={this.state.lastGistUrl}>here</a>.
      </div>
    );
  }
});

ReactDOM.render(
  <div>hello</div>,
  document.getElementById('container')
);
