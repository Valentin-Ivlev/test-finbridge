<template>
  <a-card
      hoverable
      style='width: 100%'
      :loading='loading'
  >
    <a-form
        :model='message'
        :label-col='labelCol'
        :wrapper-col='wrapperCol'
        :rules='rules'
    >
      <a-form-item
          label='Сообщение'
          v-bind='validationErrors.text'
      >
        <a-input
            v-model:value='message.text'
        />
      </a-form-item>
      <a-form-item
          :wrapper-col='{ span: 14, offset: 4 }'
      >
        <a-button
            size='large'
            type='primary'
            @click='handleSubmit'
        >
          {{ isEdit ? 'Обновить' : 'Отправить' }}
        </a-button>
        <a-button
            size='large'
            style='margin-left: 10px'
            @click='resetFields'
            v-if='!isEdit'
        >
          Reset
        </a-button>
        <a-button
            size='large'
            style='margin-left: 10px'
            @click='showAllMessages'
            danger
        >
          Cancel
        </a-button>
      </a-form-item>
    </a-form>
  </a-card>
</template>
<script>
import api from '../api';
import {Form} from 'ant-design-vue';
import {reactive} from 'vue';
import {useRouter} from 'vue-router'

const {useForm} = Form;

export default {

  setup(props) {
    let message = reactive({
      text: '',
      send_at: '',
      status: '',
    });

    const rules = reactive({
      text: [
        {
          required: true,
          message: 'Напишите сообщение',
          trigger: 'blur'
        },
      ],
    });

    const {
      resetFields,
      validate,
      validateInfos: validationErrors
    } = useForm(message, rules);

    const router = useRouter();

    const handleSubmit = () => {
      validate()
          .then(
              async () => {
                const {messageId} = props;
                const current = new Date();
                const dat = `${current.getFullYear()}-${current.getMonth()+1}-${current.getDate()} ${current.getHours()}:${current.getMinutes()}:${current.getSeconds()}`;
                message.send_at=dat;
                await api.helpSend('message/send', message)
                  .then(response => {
                    var res=JSON.parse(response);
                    console.log(res);
                    if (res.ok==true) {
                      message.status='sent';
                    } else {
                      message.status='not sent';
                    }
                  })
                  .catch(err => {
                    console.log(err);
                  });
                const updatedMessage = !!messageId ?
                  await api.helpPatch(`messages/${messageId}`, message) :
                  await api.helpPost('messages', message);
                Object.assign(message, updatedMessage);
                router.push({name: 'messages'});
              }
          )
          .catch(() => {
          });
    }

    return {
      resetFields,
      validationErrors,
      message,
      handleSubmit,
      rules
    };
  },
  props: ['messageId'],
  data() {
    return {
      isEdit: !!this.messageId,
      loading: !!this.messageId,
      labelCol: {span: 4},
      wrapperCol: {span: 14},
    }
  },
  methods: {
    async loadMessage() {
      Object.assign(this.message, await api.helpGet(`messages/${this.messageId}`));
      this.loading = false;
    },
    showAllMessages() {
      this.$router.push({name: 'messages'});
    },
  },
  async mounted() {
    if (this.isEdit) {
      await this.loadMessage();
    }
  }
};
</script>