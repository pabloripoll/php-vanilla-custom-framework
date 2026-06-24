# MongoDB

Install the official MongoDB library via Composer first using
```bash
$ composer require mongodb/mongodb
$ composer require mongodb/mongodb --ignore-platform-reqs
```

You only need to run this command ONCE (e.g., in a migration, database seeder, or terminal)
```php
Doc::conn()->selectCollection('users')->createIndex(['email' => 1], ['unique' => true]);
```

```php
public function insertMongodb(Request $request)
{
    try {
        $mongo = Doc::conn();
        $collection = $mongo->selectCollection('users');

        // This will block duplicate emails from being created due to the unique index
        $collection->insertOne([
            'username' => 'john_doe',
            'email' => 'john@example.com'
        ]);

        $users = $collection->find([])->toArray();

        return response()->json([
            'status' => true,
            'data' => $users
        ]);

    } catch (\MongoDB\Driver\Exception\BulkWriteException $e) {
        // Intercept MongoDB unique validation failures natively
        if ($e->getWriteResult()->getWriteErrors()[0]->getCode() === 11000) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error: This email address is already registered.'
            ], 422); // HTTP 422 Unprocessable Entity
        }

        return response()->json([
            'status' => false,
            'message' => 'A MongoDB bulk write error occurred.',
            'error' => $e->getMessage()
        ], 500);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'General connection or application error.',
            'error' => $e->getMessage()
        ], 500);
    }
}
```