import React from 'react';
import Menu from '@mui/joy/Menu';
import MenuButton from '@mui/joy/MenuButton';
import MenuItem from '@mui/joy/MenuItem';
import Dropdown from '@mui/joy/Dropdown';

const MenuBar = () => {
  return (
    <Dropdown>
      <MenuButton>Account</MenuButton>
      <Menu>
        <MenuItem>Login</MenuItem>
      </Menu>
    </Dropdown>
  );
};

export default MenuBar;
