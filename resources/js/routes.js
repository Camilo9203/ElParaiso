import Vue from 'vue';
import VueRouter from 'vue-router';
import Manager from "./views/Manager";
import Folder from './views/Folder'

Vue.use(VueRouter)

export default new VueRouter ({
    routes: [
        {
            path: '/data',
            name: 'data',
            component: Manager,
        }
        ,
        {
            path: '/folder/:id',
            name: 'folder',
            component: Folder,
            props: true
        }
    ],
    mode: 'history' //#
})

//