public function test_client_can_create_a_product()
    {
        // Given
        $productData = [
            'name' => 'Super Product',
            'price' => '23.30'
        ];

        // When
        $response = $this->json('POST', '/api/products', $productData); 

        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(201);
        
        // Assert the response has the correct structure
        $response->assertJsonStructure([
            'id',
            'name',
            'price'
        ]);

        // Assert the product was created
        // with the correct data
        $response->assertJsonFragment([
            'name' => 'Super Product',
            'price' => '23.30'
        ]);
        
        $body = $response->decodeResponseJson();

        // Assert product is on the database
        $this->assertDatabaseHas(
            'products',
            [
                'id' => $body['id'],
                'name' => 'Super Product',
                'price' => '23.30'
            ]
        );
    }

    public function test_client_can_show_a_product()
    {
        // Given
        $productData = [
            'name' => 'Super Product',
            'price' => '23.30'
        ];

        // When
        $response = $this->json('POST', '/api/products', $productData); 

        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(201);
        
        // Assert the response has the correct structure
        $response->assertJsonStructure([
            'id',
            'name',
            'price'
        ]);

        // Assert the product was created
        // with the correct data
        $response->assertJsonFragment([
            'name' => 'Super Product',
            'price' => '23.30'
        ]);
        
        $body = $response->decodeResponseJson();

        // Assert product is on the database
        $this->assertDatabaseHas(
            'products',
            [
                'id' => $body['id'],
                'name' => 'Super Product',
                'price' => '23.30'
            ]
        );
        
        $id = $body['id'];
        $response = $this->json('GET', '/api/products/'. $id .'');
        $response->assertStatus(200);
        $body = $response->decodeResponseJson();
        $this->assertDatabaseHas(
            'products',
            [
                'id' => '2',
                'name' => 'Super Product',
                'price' => '23.30'
            ]
        );
    }
    
    public function test_client_can_delete_products()
    {
        // Given
        $productData = [
            'name' => 'Super Product',
            'price' => '23.30'
        ];

        // When
        $response = $this->json('POST', '/api/products', $productData); 

        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(201);
        
        // Assert the response has the correct structure
        $response->assertJsonStructure([
            'id',
            'name',
            'price'
        ]);

        // Assert the product was created
        // with the correct data
        $response->assertJsonFragment([
            'name' => 'Super Product',
            'price' => '23.30'
        ]);
        
        $body = $response->decodeResponseJson();

        // Assert product is on the database
        $this->assertDatabaseHas(
            'products',
            [
                'id' => $body['id'],
                'name' => 'Super Product',
                'price' => '23.30'
            ]
        );

        $response = $this->call('DELETE', '/api/products/2');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseMissing('products', [
            'id' => '2',
            'name' => 'Super Product',
            'price' => '23.30'
        ]);
    }

    public function test_client_can_update_a_product()
    {
        // Given
        $productData = [
            'name' => 'Super Product',
            'price' => '23.30'
        ];

        // When
        $response = $this->json('POST', '/api/products', $productData); 

        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(201);
        
        // Assert the response has the correct structure
        $response->assertJsonStructure([
            'id',
            'name',
            'price'
        ]);

        // Assert the product was created
        // with the correct data
        $response->assertJsonFragment([
            'name' => 'Super Product',
            'price' => '23.30'
        ]);
        
        $body = $response->decodeResponseJson();

        // Assert product is on the database
        $this->assertDatabaseHas(
            'products',
            [
                'id' => $body['id'],
                'name' => 'Super Product',
                'price' => '23.30'
            ]
        );


        $id = $body['id'];


        $primerValor = $this->json('GET', '/api/products/'. $id .'');
        // Given
        $productDataNuevo = [
            'name' => 'Producto 2',
            'price' => '23.30'
        ];

        $response2 = $this->json('PUT', '/api/products/'. $id .'', $productDataNuevo);

        $this->assertEquals(200, $response2->getStatusCode());

        $segundoValor = $this->json('GET', '/api/products/'. $id .'');

        $this->assertJsonStringNotEqualsJsonString(
            json_encode($primerValor),
            json_encode($segundoValor)
        );

        //print_r(json_encode($primerValor). ' =/= '. json_encode($segundoValor));

        $this->assertDatabaseHas(
            'products',
            [
                'id' => $id,
                'name' => 'Producto 2',
                'price' => '23.30'
            ]
        );
    }

    public function test_client_can_show_all_products()
    {
        // Given
        $productData = [
            'name' => 'Super Product',
            'price' => '23.30'
        ];

        // When
        $response = $this->json('POST', '/api/products', $productData); 

        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(201);
        
        // Assert the response has the correct structure
        $response->assertJsonStructure([
            'id',
            'name',
            'price'
        ]);

        // Assert the product was created
        // with the correct data
        $response->assertJsonFragment([
            'name' => 'Super Product',
            'price' => '23.30'
        ]);
        
        $body = $response->decodeResponseJson();

        // Assert product is on the database
        $this->assertDatabaseHas(
            'products',
            [
                'id' => $body['id'],
                'name' => 'Super Product',
                'price' => '23.30'
            ]
        );

        $id1 = $body['id'];


        // Given
        $productData = [
            'name' => 'Control xbox',
            'price' => '659.80'
        ];

        // When
        $response = $this->json('POST', '/api/products', $productData); 

        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(201);
        
        // Assert the response has the correct structure
        $response->assertJsonStructure([
            'id',
            'name',
            'price'
        ]);

        // Assert the product was created
        // with the correct data
        $response->assertJsonFragment([
            'name' => 'Control xbox',
            'price' => '659.80'
        ]);
        
        $body = $response->decodeResponseJson();

        // Assert product is on the database
        $this->assertDatabaseHas(
            'products',
            [
                'id' => $body['id'],
                'name' => 'Control xbox',
                'price' => '659.80'
            ]
        );

        $id2 = $body['id'];


        $request = $this->json('GET', '/api/products/');
        $this->assertEquals(200, $request->getStatusCode());
        $this->assertDatabaseHas(
            'products',
            [
                'id' => $id1,
                'name' => 'Super Product',
                'price' => '23.30'
            ]
        );

        $this->assertDatabaseHas(
            'products',
            [
                'id' => $id2,
                'name' => 'Control xbox',
                'price' => '659.80'
            ]
        );


        $producto1 = $this->json('GET', '/api/products/'. $id1 .'');
        $producto2 = $this->json('GET', '/api/products/'. $id2 .'');

        //$resultado = array_merge(json_encode($producto1, true), json_encode($producto2, true));

       // json_encode($resultado);

        /*$todo = $producto1 . ',' . $producto2;

        $this->assertJsonStringEqualsJsonString(
            json_encode($todo),
            json_encode($request)
        );*/

        //$this->assertEquals($todo, json_encode($request));
    }