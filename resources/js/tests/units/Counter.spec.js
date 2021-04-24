import { mount } from '@vue/test-utils';
import expect from 'expect';
import Counter from '../.././components/Counter.vue';

describe('Counter.vue', () => {
  it('says that it is an example component', () => {
    const wrapper = mount(Counter);
    expect(wrapper.html()).toContain('Example Component');
  });
});