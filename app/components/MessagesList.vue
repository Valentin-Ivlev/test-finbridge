<template>
  <a-button
      type='primary'
      style='margin-bottom: 8px'
      @click='showAddMessageForm'
  >
    Новое сообщение
  </a-button>
  <a-table
      :dataSource='messages'
      :columns='columns'
      rowKey='id'
      bordered
  >
  </a-table>
</template>
<script>
import api from '../api';
import {
  PlusOutlined,
  EyeOutlined,
  EditOutlined,
  DeleteOutlined,
  WarningOutlined
} from '@ant-design/icons-vue';

export default {
  components: {
    PlusOutlined,
    EditOutlined,
    EyeOutlined,
    DeleteOutlined,
    WarningOutlined
  },
  data() {
    return {
      messages: [],
      columns: [
        {
          title: 'Сообщение',
          dataIndex: 'text',
          key: 'text',
          ellipsis: true
        },
        {
          title: 'Дата, время',
          dataIndex: 'send_at',
          key: 'send_at',
        },
        {
          title: 'Статус',
          dataIndex: 'status',
          key: 'status',
        },
      ]
    };
  },
  methods: {
    showAddMessageForm() {
      this.$router.push('/message/add');
    }
  },
  async mounted() {
    this.messages = await api.helpGet('messages');
  }
};
</script>