module.exports = {
  content: ["./frontend/web/redesign/source/**", "./frontend/views/**/*.php", "./frontend/components/**/*.php"],
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
      'gray-light-3': 'rgba(0,0,0, 0.08)',
      'gray-light-4': '#f1f3f8',
      black: '#000000',
      primary: '#3D4043',
      secondary: '#F7F5F2',
      orange: '#DD7700',
      danger: 'red',
      'orange-light': '#E7C38E',
      brown: '#827360',
      'brown-2': '#7D6F5F',
      green: '#4F724A',
      blue: '#475871',
      'blue-2': '#697785',
      'brown-light': '#EEEAE8',
      'brown-light-2': '#EEDED3',
      'brown-light-3': '#E3DCD7',
      hover: '#FEF3E6',
      'hover-2': '#EAE1DC',
      'hover-3': '#F2F2F2',
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
      'base-2': ['16px', '24px'],
      lg: ['18px', '28px'],
      xl: ['20px', '28px'],
      '2xl': ['24px', '32px'],
      '3xl': ['30px', '40px'],
      '3.2xl': ['32px', '42px'],
      '4xl': ['40px', '50px'],
      '4.8xl': ['48px', '58px'],
      '5xl': ['52px', '68px'],
      '6xl': ['60px', '70px'],
      '7xl': ['88px', '95px'],
      '8xl': ['96px', '110px'],
      '9xl': ['128px', '130px'],
    },
    container: {
      screens: {
        sm: '768px',
        md: '948px',
        lg: '1024px',
        xl: '1280px',
        '2xl': '1496px',
      },
    },
    backgroundSize: {
      'auto': 'auto',
      'cover': 'cover',
      'contain': 'contain',
      '115': '115%',
      '110': '110%',
      '100': '100%',
    }
  },
  experimental: {
    applyComplexClasses: true,
  },
};
