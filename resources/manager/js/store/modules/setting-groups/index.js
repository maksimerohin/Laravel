import {uniqueFieldEditMixin, uniqueFieldMixin} from "../../mixins/getters";
import {axiosAction} from "../../mixins/actions";

const state = {
    fields: {
        title: '',
        alias: '',
        description: ''
    },
    items: []
};

const mutations = {
    UPDATE_FIELD(state, payload) {
        state.fields[payload.field] = payload.value;
    },
    UPDATE_ITEMS(state, payload) {
        state.items = payload;
    },
    DELETE_ITEM(state, payload) {
        state.items = state.items.filter(item => item.id !== payload);
    },
    CLEAR_FIELDS(state) {
        for(let field of Object.keys(state.fields)) {
            state.fields[field] = '';
        }
    },
    SET_ITEM_FIELDS(state, payload) {
        for(let item of state.items) {
            if(item.id === +payload) {
                for(let field in state.fields) {
                    state.fields[field] = item[field] === null ? '' : item[field];
                }
            }
        }
    },
    UPDATE_FIELDS(state, payload) {
        for(let field of Object.keys(state.fields)) {
            state.fields[field] = payload[field] === null ? '' : payload[field];
        }
    },
    UPDATE_SETTING_VALUE(state, payload) {
        state.items.map(item => {
            item[payload.group].map(setting => {
                if (setting.key_name === payload.key_name) {
                    setting.value = payload.value;
                }
            })
        })
    }
};

const actions = {
    getItems(context) {
        return axiosAction('get', context, {
            url: '/api/manager/setting-groups',
            thenContent: response => context.commit('UPDATE_ITEMS', response.data)
        })
    },
    getItemsWithSettings(context) {
        return axiosAction('get', context, {
            url: '/api/manager/setting-groups/with-settings',
            thenContent: response => context.commit('UPDATE_ITEMS', response.data)
        })
    },
    getItem(context, id) {
        return axiosAction('get', context, {
            url: `/api/manager/setting-groups/${id}`,
            thenContent: response => context.commit('UPDATE_FIELDS', response.data)
        })
    },
    store(context, payload) {
        const form = new FormData();
        for(const [field, value] of Object.entries(payload)) {
            form.append(field, value);
        }
        return axiosAction('post', context, {
            url: '/api/manager/setting-groups',
            data: form
        })
    },
    update(context, payload) {
        const form = new FormData();
        for(const [field, value] of Object.entries(payload.formData)) {
            form.append(field, value);
        }
        return axiosAction('post', context, {
            url: `/api/manager/setting-groups/${payload.id}`,
            data: form
        })
    },
    destroy(context, id) {
        return axiosAction('delete', context, {
            url: `/api/manager/setting-groups/${id}`,
            thenContent: response => context.commit('DELETE_ITEM', id)
        })
    },
    setItemFields(context, itemId) {
        return context.commit('SET_ITEM_FIELDS', itemId);
    },
    updateField(context, payload) {
        context.commit('UPDATE_FIELD', payload);
    },
    clearFields(context) {
        context.commit('CLEAR_FIELDS');
    }
};

const getters = {
    isUniqueTitle: state => value => uniqueFieldMixin(state.items, 'title', value),
    isUniqueTitleEdit: state => (value, id) => uniqueFieldEditMixin(state.items, 'title', value, id),
    isUniqueAlias: state => title => uniqueFieldMixin(state.items, 'alias', title),
    isUniqueAliasEdit: state => (title, id) => uniqueFieldEditMixin(state.items, 'alias', title, id),
    firstGroupId: state => state.items.slice(0, 1)[0] ? state.items.slice(0, 1)[0].id : ''
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
