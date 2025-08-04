import React from 'react';
import {Button, FormControl, FormLabel, Grid, Input, Sheet, styled, Typography} from "@mui/joy";
import '@fontsource/inter';
import Select from '@mui/joy/Select';
import Option from '@mui/joy/Option';
import {AdapterDayjs} from '@mui/x-date-pickers/AdapterDayjs';
import {LocalizationProvider} from '@mui/x-date-pickers/LocalizationProvider';
import {DateTimePicker} from "@mui/x-date-pickers";
import {TextareaAutosize as BaseTextareaAutosize} from "@mui/material";
import InputFileUpload from "./FileUpload";

const blue = {
  100: '#DAECFF', 200: '#b6daff', 400: '#3399FF', 500: '#007FFF', 600: '#0072E5', 900: '#003A75',
};

const grey = {
  50: '#F3F6F9',
  100: '#E5EAF2',
  200: '#DAE2ED',
  300: '#C7D0DD',
  400: '#B0B8C4',
  500: '#9DA8B7',
  600: '#6B7A90',
  700: '#434D5B',
  800: '#303740',
  900: '#1C2025',
};

const TextareaAuto = styled(BaseTextareaAutosize)(({theme}) => `
    box-sizing: border-box;
    width: 320px;
    font-family: 'IBM Plex Sans', sans-serif;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    padding: 12px;
    border-radius: 12px 12px 0;
    color: ${theme.palette.mode === 'dark' ? grey[300] : grey[900]};
    background: ${theme.palette.mode === 'dark' ? grey[900] : '#fff'};
    border: 1px solid ${theme.palette.mode === 'dark' ? grey[700] : grey[200]};
    box-shadow: 0 2px 2px ${theme.palette.mode === 'dark' ? grey[900] : grey[50]};

    &:hover {
      border-color: ${blue[400]};
    }

    &:focus {
      outline: 0;
      border-color: ${blue[400]};
      box-shadow: 0 0 0 3px ${theme.palette.mode === 'dark' ? blue[600] : blue[200]};
    }

    /* firefox */
    &:focus-visible {
      outline: 0;
    }
  `,);


const submitPartnerForm = async (formData) => {
  console.log(JSON.stringify(formData));
  const eventName = formData.get("eventDescription");
  const eventDescription = formData.get("eventName");
  const groupName = formData.get("groupName");
  const eventImage = formData.get("eventImage");
  const startTime = formData.get("startTime");
  const endTime = formData.get("endTime");
  console.log(
    "groupName", groupName,
    "desc", eventDescription,
    "eventName", eventName,
    "eventImage", eventImage,
    "startTime", startTime,
    "endTime", endTime
  );

  const capturedForm = {
    eventDescription: eventDescription,
    eventName: eventName,
    partnerId: parseInt(groupName),
    eventStartTime: startTime,
    eventEndTime: endTime,
    published: false
  };

    // Send image file to API upload.
    try {
      console.log('eventImage', eventImage);
      const formData = new FormData();
      formData.set('file', eventImage);
      formData.append('file', eventImage);
      console.log('formData', formData);
      const response = await fetch('/api/media_objects', {
        body: formData,
      });

      if (!response.ok) {
        console.log('response not ok');
        // throw new Error('Network response was not ok');
      }

      const responseData = await response.json();
      // Handle the response data
      console.log(responseData);

      // Add the ID and contentURL for PartnerCommunicationForm.
      capturedForm.imageId = responseData.id;
      capturedForm.eventImage = responseData.contentUrl;

    } catch (error) {
      console.error('Error:', error);
    }

    // Send to API-Platform for PartnerCommunicationForm.
    try {
      const response = await fetch('/api/events', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/ld+json',
        },
        body: JSON.stringify(capturedForm),
      });

      if (!response.ok) {
        console.log('response not ok');
        // throw new Error('Network response was not ok');
      }

      const responseData = await response.json();
      // Handle the response data
      console.log(responseData);
    } catch (error) {
      console.error('Error:', error);
    }

}

function onSubmit(event) {
  // event.preventDefault();
  // console.log(event);
  // const {groupName, eventName, eventDescription} = event.currentTarget.elements;
  // console.log({
  //   groupName: groupName,
  //   eventName: eventName,
  //   eventDescription: eventDescription.value
  // });
  // console.log("entered submit form.");
  // console.log("event", event);
  // console.log("elements", event.currentTarget.elements);
  // const formData = new FormData(event);
  // console.log("entries", formData.entries());
  // const formJson = Object.fromEntries(formData.entries());
  // console.log("formJson", formJson);
  // console.log("stringified json", JSON.stringify(formJson));
}

const PartnerCommunicationForm = () => {
  // Todo: Get the partner group names.
  // Setup onSubmit
  // Form needs:
  // Group the event is for.
  // Event Name
  // Event description
  // Date and time.
  // If it is recurring (This could be a phase 2 dev) Some complexity here.
  //    How is it recurring. Weekly? Monthly? Every two weeks?
  //    We'll need to confirm dates before continuing.
  // Image upload (required).
  // What places to promote.
  //    Facebook, Instagram, Meetup.

  // const onSubmit = (values) => {
  //   console.log(values)
  // }

  const initialValues = {};

  return (<>
    <Grid container justify="center" spacing={1}>
      <Grid md={3}/>
      <Grid md={6}>
        <Sheet
          sx={{
            mx: 'auto',
            my: 4,
            py: 3,
            px: 2,
            display: 'flex',
            flexDirection: 'column',
            gap: 2,
            borderRadius: 'sm',
            boxShadow: 'md',
          }}
          variant="outlined"
        >
          <div>
            <Typography level="h4" component="h1">
              <strong>Tell us about your next event</strong>
            </Typography>
            <Typography level="body-sm">We'll advertise to multiple channels with Reason Center.</Typography>
          </div>
          <form
            action={submitPartnerForm} onSubmit={onSubmit}>
            <FormControl>
              <FormLabel title="Select the Group">
                Select the group
              </FormLabel>
              <Select id="groupName" name="groupName" required defaultValue="1">
                <Option value="1">Atheists and Other Freethinkers</Option>
                <Option value="2">FFRF</Option>
                <Option value="3">Sunday Assembly</Option>
                <Option value="3">Sac Area Skeptics</Option>
              </Select>
            </FormControl>
            <FormControl>
              <FormLabel>
                Event Name
              </FormLabel>
              <Input id="eventName" name="eventName" required/>
            </FormControl>
            <FormControl>
              <FormLabel>
                Event Description
              </FormLabel>
              <TextareaAuto
                required
                id="eventDescription"
                name="eventDescription"
                minRows={4}
              />
            </FormControl>
            <FormControl>
              <FormLabel>
                Event Image
              </FormLabel>
              <InputFileUpload inputName="eventImage"/>
            </FormControl>
            <FormControl>
              <FormLabel>
                Start Time
              </FormLabel>
              <LocalizationProvider  dateAdapter={AdapterDayjs}>
                <DateTimePicker name="startTime" slotProps={{
                  textField: {
                    required: true,
                  },
                }}/>
              </LocalizationProvider>
            </FormControl>
            <FormControl>
              <FormLabel>
                End Time
              </FormLabel>
              <LocalizationProvider  dateAdapter={AdapterDayjs}>
                <DateTimePicker name="endTime" slotProps={{
                  textField: {
                    required: true,
                  },
                }} />
              </LocalizationProvider>
            </FormControl>

            {/*<Grid xs={12} sm={12} md={12}>*/}
            {/*  <Typography>Is this recurring?</Typography>*/}
            {/*  <FormControlLabel control={<Switch/>} label="Recurring"/>*/}
            {/*</Grid>*/}
            <FormControl>
              <Button type="submit">Submit</Button>
            </FormControl>
          </form>
        </Sheet>
      </Grid>
      <Grid md={3}/>
    </Grid>
  </>);
};

export default PartnerCommunicationForm;
