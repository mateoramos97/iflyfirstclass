module.exports = {
  content: ["./frontend/web/redesign/dist/**", "./frontend/views/**/*.php", "./frontend/components/**/*.php"],
  theme: {
    screens: {
      'sm': '640px',
      // => @media (min-width: 640px) { ... }
      'md': '768px',
      // => @media (min-width: 768px) { ... }
      'lg': '1024px',
      // => @media (min-width: 1024px) { ... }
      'xl': '1280px',
      '2xl': '1496px',
      // => @media (min-width: 1280px) { ... }
      'max-xl': {'max': '1279px'},
      // => @media (max-width: 1279px) { ... }

      'max-lg': {'max': '1023px'},
      // => @media (max-width: 1023px) { ... }

      'max-md': {'max': '767px'},
      // => @media (max-width: 767px) { ... }

      'max-sm': {'max': '639px'},
      // => @media (max-width: 639px) { ... }
    },
    colors: {
      gray: '#606368',
      'gray-2': '#787a7c',
      'gray-light': '#DBDCE0',
      'gray-light-2': '#E2E2E3',
      black: '#000000',
      primary: '#3D4043',
      secondary: '#F7F5F2',
      orange: '#DD7700',
      danger: 'red',
      'orange-light': '#E7C38E',
      brown: '#827360',
      green: '#4F724A',
      blue: '#475871',
      'brown-light': '#EEEAE8',
      'brown-light-2': '#EEDED3',
      'brown-light-3': '#E3DCD7',
      hover: '#FEF3E6',
      white: '#ffffff',
      'black-light': '#241f1e',
      'black-light-2': '#31302F',
      mute: 'rgba(0,0,0, 0.5)',
    },
    fontSize: {
      ns: ['6px', 1],
      xs: ['11px', '16px'],
      sm: ['13px', '18px'],
      base: ['15px', '22px'],
      lg: ['18px', '28px'],
      xl: ['20px', '28px'],
      '2xl': ['24px', '32px'],
      '3xl': ['30px', '40px'],
      '4xl': ['40px', '50px'],
      '5xl': ['52px', '66px'],
      '6xl': ['60px', '70px'],
      '7xl': ['88px', '95px'],
      '8xl': ['96px', '110px'],
    },
    container: {
      screens: {
        sm: '600px',
        md: '728px',
        lg: '984px',
        xl: '1240px',
        '2xl': '1496px',
      },
    }
  },
  experimental: {
    applyComplexClasses: true,
  },
};
