/**
 * START SETUP
 */

// CUSTOMERS
db.customers.drop();
db.createCollection("customers", {
    validator: {
        $jsonSchema: {
            bsonType: "object",
            required: [
                "firstname",
                "lastname",
                "address",
                "phone",
                "points",
                "datejoined",
            ],
            properties: {
                firstname: {
                    bsonType: "string",
                },
                lastname: {
                    bsonType: "string",
                },
                address: {
                    bsonType: "string",
                },
                phone: {
                    bsonType: "string",
                },
                points: {
                    bsonType: "long",
                },
                datejoined: {
                    bsonType: "date",
                },
            },
        },
    },
});
db.customers.insert([{
    firstname: "John",
    lastname: "Doe",
    address: "1 Generic Street, Townsville",
    phone: "4085551111",
    points: NumberLong(6192),
    datejoined: new Date("2020-11-06 05:15:00"),
}, {
    firstname: "Mary",
    lastname: "Sue",
    address: "1 Generic Street, Townsville",
    phone: "4085552222",
    points: NumberLong(91023),
    datejoined: new Date("2020-11-06 05:15:00"),
}, {
    firstname: "Sherlock",
    lastname: "Holmes",
    address: "221B Baker Street, London",
    phone: "4085554415",
    points: NumberLong(903),
    datejoined: new Date("1998-09-08 17:30:00"),
}]);

// EMPLOYEES
db.employees.drop();
db.createCollection("employees", {
    validator: {
        $jsonSchema: {
            bsonType: "object",
            required: [
                "firstname",
                "lastname",
                "address",
                "phone",
                "salary",
                "ismanager",
            ],
            properties: {
                firstname: {
                    bsonType: "string",
                },
                lastname: {
                    bsonType: "string",
                },
                address: {
                    bsonType: "string",
                },
                phone: {
                    bsonType: "string",
                },
                salary: {
                    bsonType: "double",
                },
                ismanager: {
                    bsonType: "bool",
                },
                worklocation: {
                    bsonType: "objectId",
                },
            },
        },
    },
});
db.employees.insert([{
    firstname: "Romeo",
    lastname: "Montague",
    address: "70 Right Side Way, San Jose",
    phone: "4085551000",
    salary: 90341.01,
    ismanager: false,
}, {
    firstname: "Juliet",
    lastname: "Capulet",
    address: "70 Left Side Way, San Jose",
    phone: "4085550001",
    salary: 60783.78,
    ismanager: false,
}, {
    firstname: "Bruce",
    lastname: "Wayne",
    address: "777 Bat Cave, San Francisco",
    phone: "4085557777",
    salary: 803213.19,
    ismanager: true,
}]);

// PRODUCTS
db.products.drop();
db.createCollection("products", {
    validator: {
        $jsonSchema: {
            bsonType: "object",
            required: [
                "name",
                "description",
                "price",
                "upc",
            ],
            properties: {
                name: {
                    bsonType: "string",
                },
                description: {
                    bsonType: "string",
                },
                price: {
                    bsonType: "double",
                },
                upc: {
                    bsonType: "string",
                },
            },
        },
    },
});
db.products.insert([{
    name: "iMac",
    description: "Powerful personal desktop computer created by Apple.",
    price: 1999.99,
    upc: "124357194726",
}, {
    name: "Teddy Bear",
    description: "Warm stuffed bear toy.",
    price: 8.99,
    upc: "193456275649",
}, {
    name: "Desk Lamp",
    description: "Really bright.",
    price: 19.99,
    upc: "725354533901",
}]);

// LOCATIONS
db.locations.drop();
db.createCollection("locations", {
    validator: {
        $jsonSchema: {
            bsonType: "object",
            required: [
                "name",
                "phone",
                "address",
                "employees",
                "inventory",
            ],
            properties: {
                name: {
                    bsonType: "string",
                },
                phone: {
                    bsonType: "string",
                },
                address: {
                    bsonType: "string",
                },
                employees: {
                    bsonType: "array",
                },
                inventory: {
                    bsonType: "array",
                },
            },
        },
    },
});
employeeArr = db.employees.find({}).toArray();
productArr = db.products.find({}).toArray();
db.locations.insert([{
    name: "MartWal A",
    phone: "2031234567",
    address: "123 Shire Way, London",
    employees: employeeArr.slice(0, Math.floor(employeeArr.length / 2)).map(employee => {
        return employee._id;
    }),
    inventory: productArr.slice(0, Math.floor(productArr.length / 2)).map(product => {
        return {
            productid: product._id,
            stock: NumberInt(Math.floor(Math.random() * 21)),
        };
    }),
}, {
    name: "MartWal B",
    phone: "2031234568",
    address: "234 Mordor Dr, London",
    employees: employeeArr.slice(Math.floor(employeeArr.length / 2)).map(employee => {
        return employee._id;
    }),
    inventory: productArr.slice(Math.floor(productArr.length / 2)).map(product => {
        return {
            productid: product._id,
            stock: NumberInt(Math.floor(Math.random() * 21)),
        };
    }),
}, {
    name: "MartWal C",
    phone: "2031234569",
    address: "345 Gondor St, London",
    employees: [],
    inventory: [],
}]);

// SET INITIAL EMPLOYEE WORK LOCATIONS
locationsArr = db.locations.find({}).toArray();
db.employees.update({
    firstname: "Romeo",
    lastname: "Montague",
}, {
    $set: {
        worklocation: locationsArr[0]._id,
    },
});
db.employees.update({
    firstname: "Juliet",
    lastname: "Capulet",
}, {
    $set: {
        worklocation: locationsArr[1]._id,
    },
});
db.employees.update({
    firstname: "Bruce",
    lastname: "Wayne",
}, {
    $set: {
        worklocation: locationsArr[2]._id,
    },
});

// TIMETABLES
db.timetables.drop();
db.createCollection("timetables", {
    validator: {
        $jsonSchema: {
            bsonType: "object",
            required: [
                "starttime",
                "endtime",
                "locationid",
                "employeeid",
            ],
            properties: {
                starttime: {
                    bsonType: "date",
                },
                endtime: {
                    bsonType: "date",
                },
                locationid: {
                    bsonType: "objectId",
                },
                employeeid: {
                    bsonType: "objectId",
                },
            },
        },
    },
});
locationsArr = db.locations.find({}).toArray();
employeesArr = db.employees.find({}).toArray();
db.timetables.insert([{
    starttime: new Date(),
    endtime: new Date(),
    locationid: locationsArr[0]._id,
    employeeid: employeesArr[0]._id,
}, {
    starttime: new Date(),
    endtime: new Date(),
    locationid: locationsArr[1]._id,
    employeeid: employeesArr[1]._id,
}, {
    starttime: new Date(),
    endtime: new Date(),
    locationid: locationsArr[2]._id,
    employeeid: employeesArr[2]._id,
}]);

// CREATE INDEXES
db.employees.createIndex({
    worklocation: 1,
});
db.products.createIndex({
    name: 1,
});
db.products.createIndex({
    price: 1,
});

/**
 * END SETUP
 */

// FIND EMPLOYEES WITH SALARY > 100000
db.employees.find({
    salary: {
        $gte: 100000,
    }
});

// UPDATE EMPLOYEE WORK LOCATION
employeeToUpdate = db.employees.find({
    firstname: "Romeo",
    lastname: "Montague",
}).toArray()[0];
newWorkLocation = db.locations.find({
    name: "MartWal B",
}).toArray()[0];

db.locations.update({ // Remove employee from old location employee list
    _id: employeeToUpdate.worklocation,
}, {
    $pull: {
        employees: employeeToUpdate._id,
    },
});
db.locations.update({ // Add employee to new location employee list
    _id: newWorkLocation._id,
}, {
    $push: {
        employees: employeeToUpdate._id,
    },
});
db.employees.update({
    firstname: "Romeo",
    lastname: "Montague",
}, {
    $set: {
        worklocation: newWorkLocation._id,
    },
});

// DELETE PRODUCT
productToDelete = db.products.find({
    name: "iMac",
}).toArray()[0];

db.locations.update({}, { // Remove product from all location inventories
    $pull: {
        inventory: {
            productid: productToDelete._id,
        },
    },
});
db.products.deleteOne({
    _id: productToDelete._id,
});