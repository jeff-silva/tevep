<template><div>
    <ui-form>
        <!-- <template #success>Success</template> -->
        <!-- <template #error>Error</template> -->
        <template #content>
            <ui-tabs>
                <template #content>
                    <div data-title="Login">
                        <ui-form-field>
                            <template #label>Nome</template>
                            <template #input>
                                <input type="text" class="form-control">
                            </template>
                        </ui-form-field>

                        <ui-form-field>
                            <template #label>E-mail</template>
                            <template #input>
                                <input type="email" class="form-control">
                            </template>
                        </ui-form-field>

                        <ui-form-field>
                            <template #label>Opção</template>
                            <template #input>
                                <ui-select>
                                    <template #selected="{option}">{{ option }}</template>
                                    <template #options="{select}">
                                        <div class="p-2" @click="select('Aaa')">Aaa</div>
                                        <div class="p-2" @click="select('Bbb')">Bbb</div>
                                        <div class="p-2" @click="select('Ccc')">Ccc</div>
                                    </template>
                                </ui-select>
                            </template>
                        </ui-form-field>
                    </div>

                    <div data-title="Endereço">
                        <ui-address></ui-address>
                    </div>
                </template>
            </ui-tabs>
        </template>
    </ui-form>
</div></template>