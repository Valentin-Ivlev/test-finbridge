import {createRouter, createWebHistory} from 'vue-router';
import MessagesList from './components/MessagesList';
import MessageForm from './components/MessageForm';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            name: 'messages',
            path: '/',
            component: MessagesList,
        },
        {
            name: 'message-form',
            path: '/message/edit/:messageId?',
            component: MessageForm,
            props: true,
            alias: '/message/add'
        },
    ],
});

export default router;