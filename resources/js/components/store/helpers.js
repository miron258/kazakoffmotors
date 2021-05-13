import Vue from 'vue'
function createReactiveNestedObject(rootProp, object) {
// root is your rootProperty; e.g. state.fullReport
// object is the entire nested object you want to set

    let root = rootProp;
    const isArray = root instanceof Array;
    // you need to fill Arrays with native Array methods (.push())
    // and Object with Vue.set()

    Object.keys(object).forEach((key, i) => {
        if (object[key] instanceof Array) {
            createReactiveArray(isArray, root, key, object[key])
        } else if (object[key] instanceof Object) {
            createReactiveObject(isArray, root, key, object[key]);
        } else {
            setReactiveValue(isArray, root, key, object[key])
        }
    })
}

function createReactiveArray(isArray, root, key, values) {
    if (isArray) {
        root.push([]);
    } else {
        Vue.set(root, key, []);
    }
    fillArray(root[key], values)
}

function fillArray(rootArray, arrayElements) {
    arrayElements.forEach((element, i) => {
        if (element instanceof Array) {
            rootArray.push([])
        } else if (element instanceof Object) {
            rootArray.push({});
        } else {
            rootArray.push(element);
        }
        createReactiveNestedFilterObject(rootArray[i], element);
    })
}

function createReactiveObject(isArray, obj, key, values) {
    if (isArray) {
        obj.push({});
    } else {
        Vue.set(obj, key, {});
    }
    createReactiveNestedFilterObject(obj[key], values);
}

function setValue(isArray, obj, key, value) {
    if (isArray) {
        obj.push(value);
    } else {
        Vue.set(obj, key, value);
    }
}

export const helper = {
    createReactiveNestedObject
}
