export const strict = true;

export const state = () => ({
    edit: {},
});

export const actions = {
    async nodeCreate(ctx, tevepNode={}) {
        let tevepSave = {...tevepNode, id:''};
        tevepSave.parent_id = (ctx.state.edit.id || '');
        let resp = await this.$axios.post('/api/teveps/save', tevepSave);
        tevepNode.id = resp.data.id;
        tevepNode.parent_id = ctx.state.edit.id;
        await this.$axios.post('/api/teveps/save', ctx.state.edit);
        return resp.data;
    },
};