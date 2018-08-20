<script>
  import Replies from '../components/Replies';
  import SubscribeButton from '../components/SubscribeButton';

  export default {
    props: ['thread'],
    data() {
      return {
        repliesCount: this.thread.replies_count,
        locked: this.thread.locked,
        editing: false,
        title: this.thread.title,
        body: this.thread.body,
        form: {}
      }
    },
    methods: {
      toggleLock() {

        axios[this.locked ? 'delete' : 'post']('/locked-threads/' + this.thread.slug)

        this.locked = !this.locked;
      },
      udpate() {
        let uri = `/threads/${this.thread.channel.slug}/${this.thread.slug}`;
        axios.patch(uri, this.form).then(() => {
          this.editing = false;
          this.title = this.form.title;
          this.body = this.form.body;
          flash('Your thread has been udpated.');
        });
      },
      resetForm() {
        this.form = {
          title: this.thread.title,
          body: this.thread.body
        };

        this.editing = false;
      }
    },
    created() {
      this.resetForm();
    },
    components: {
      Replies,
      SubscribeButton
    }
  }
</script>