# TPE_Entrega3
## Endpoints:

    1. api/vuelos/,     Verbo: GET
        Traerá todos los elementos de la tabla ordenados por el id.
    2. api/vuelos/?orderBy=(parametro),     Verbo: GET
        Traerá todos los elementos de la tabla ordenados por el campo que el usuario le indique.
    3. api/vuelos/,     Verbo: POST
        Creará un nuevo item en la tabla con los datos que se le pasen por el body del request.
    4. api/vuelos/:id_vuelos,   Verbo: PUT
        Actualizará el item cuyo id coincida con el enviado por el endpoint, y lo modificará con los datos pasados en el body del request.