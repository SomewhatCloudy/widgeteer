import MemorySource from "@orbit/memory";
import JSONAPISource, {JSONAPISerializers} from "@orbit/jsonapi";
import {RecordSchema, ModelDefinition, RecordSchemaSettings} from "@orbit/records";
import Coordinator, {CoordinatorOptions, RequestStrategy, SyncStrategy} from "@orbit/coordinator";

import ModelWidget from './models/widget.model';
import ModelOrder from './models/order.model';
import {buildSerializerSettingsFor} from "@orbit/serializers";

//
let settings = {
    models: {
        widget: ModelWidget,
        order: ModelOrder
    }
};

/**
 *
 * @param schema
 * @param JSONAPISource
 * @param memorySource
 */
let start = function (schema, JSONAPISource, memorySource) {

    //
    let options = {
        sources: [JSONAPISource, memorySource],
        strategies: []
    }

    let coordinator = new Coordinator(options);

    // Json -> Memory
    coordinator.addStrategy(
        new SyncStrategy({
            source: "jsonapi",
            target: "memory",
            blocking: false
        })
    );

    // Activate
    coordinator.activate();

    return coordinator;
}

/**
 *
 */
let createMemorySource = function (schema) {

    // Cache
    // @type {MemorySource}
    let memory = new MemorySource({
        schema
    });

    return memory;
}

/**
 *
 */
let createJSONAPISource = function (schema, hostpath) {

    let jsonapi = new JSONAPISource({
        schema: schema,
        host: hostpath,
        serializerSettingsFor: buildSerializerSettingsFor({
            // See https://orbitjs.com/docs/whats-new
            settingsByType: {
                [JSONAPISerializers.ResourceType]: {
                    serializationOptions: {inflectors: ['pluralize']}
                }
            }
        })
    });

    return jsonapi;
}

//
let schema = new RecordSchema(settings),
    hostpath = process.env.MIX_API_URL;

let jsonapi = createJSONAPISource(schema, hostpath),
    memory = createMemorySource(schema)

let coordinator = start(schema, jsonapi, memory);

export {schema, jsonapi, memory, coordinator};
