## HTTP Verbs

The Getty Images API strives to use appropriate HTTP verbs to perform actions on our [resources](#resources).

| verb   | description                                          |
|--------| -----------------------------------------------------|
| GET 	 | use to retrieve a resources or collection            |
| POST	 | use to create a resource or perform a custom action  |
| PUT    | *unsupported*                                        |
| DELETE | *unsupported*                                        |

| endpoints                       |      `verb`      | `downloads` | `largest_downloads` |
|---------------------------------|------------------|-------------|---------------------|
| `api/v1/generateAPIKey`         |       GET        |             |          X          |
| `api/v1/products/all`           |       GET        |             |          X          |
| `api/v1/products/{date}`        |       GET        |             |          X          |
| `api/v1/search/products/{name}` |       GET        |       X     |          X          |
