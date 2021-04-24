import { mount, wrapper} from '@vue/test-utils'
import Counter from './components/Counter.vue';

describe('Counter', () => {
	const wrapper = mount(Counter);
  test('is a Vue instance de vue', () => { 
    expect(wrapper.isVueInstance).toBeTruthy();
  });

  test('Se monto el título', () => {  	
    wrapper.setProps({ title: 'Menú APP' });
    expect(wrapper.html().includes('Menú APP')).toBeTruthy();
  });
});