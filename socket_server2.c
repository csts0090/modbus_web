#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/socket.h>
#include <sys/un.h>
#include <unistd.h>
#include <errno.h>

/* Read text from the socket and print it out.  Continue until the
   socket closes.  Return non-zero if the client sent a "quit"
      message, zero otherwise.  */

      int server (int client_socket)
      {
	int length=10;
        char text[10];
	int ret;
       /* Read the text itself, and print it.  */
       //read (client_socket, text, length);
       ret = recv(client_socket, text , length, 0);
       if(ret==0) {
       	printf ("peer close socket\n");
	return 1;
       }
       else if (ret<0) {
       	printf("socket error: %s\n", strerror(errno));
	return 1;
       }
       else {
       	text[ret] = '\0';
       	printf ("%s\n", text);
       	return 1;
       }
       /* Free the buffer.  */
       return 0;
       }
	int main (int argc, char* const argv[])
	{
		char soc_n[15];
		sprintf(soc_n,"sch_%d",getpid());										    
		printf("name=%s\n",soc_n);
		const char* const socket_name="sch";
		printf("name=%s\n",socket_name);
		int socket_fd;
		struct sockaddr_un name;
		int client_sent_quit_message;

		/* Create the socket.  */
		socket_fd = socket (PF_LOCAL, SOCK_STREAM, 0);
		/* Indicate this is a server.  */
		name.sun_family = AF_LOCAL;
		strcpy (name.sun_path, socket_name);
		bind (socket_fd, (struct sockaddr *)&name, sizeof(struct sockaddr_un));
		/* Listen for connections.  */
		listen (socket_fd, 5);
		
	        /* Repeatedly accept connections, spinning off one server() to deal
		with each client.  Continue until a client sends a "quit" message.  */
		do {

			struct sockaddr_un client_name;
		        socklen_t client_name_len;
			int client_socket_fd;
			/* Accept a connection.  */
			client_socket_fd = accept (socket_fd, (struct sockaddr *)&client_name, &client_name_len);
			/* Handle the connection.  */
			client_sent_quit_message = server (client_socket_fd);
			/* Close our end of the connection.  */
			close (client_socket_fd);
			}
			while (!client_sent_quit_message);

	/* Remove the socket file.  */
	close (socket_fd);
	unlink (socket_name);

	return 0;
}

