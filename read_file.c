#include<stdio.h>
#include<stdlib.h>
#include<string.h>
struct f_ile
{
	char sch_id[4];
	char sta_no[3];
	char addr[5];
        char t_start[20];
	char t_stop[20];
	char period[3];
	
};
int main()
{
	int fileLength = 0;
	FILE *fptr;
	int i = 0;
	char *test;
	if(!(fptr = fopen("temp_file.txt", "r")))
		return -1;
	//移動指標到檔案的結尾
	if(fseek(fptr, 0, SEEK_END))
		return -1;
	//取得檔案的大小
	fileLength = ftell(fptr);
	//移動指標到檔案的起始
	rewind(fptr);
	char s[fileLength];
	char test2[fileLength];
	int num=0;
	while(fgets(s, fileLength, fptr) != NULL)
	{
		num++;
	}
	printf("num=%d\n",num);
	rewind(fptr);
	struct f_ile sch[num-1];
	int k=0;
	while(fgets(s, fileLength, fptr) != NULL)
	{
		if(i == 0){
			test = strtok(s, "\n");
			strcpy(test2, test);
			for(int j=0; j< num-1; j++){
				strcpy(sch[j].sch_id, test2);
			//	sch[j].sch_id[5]='\0';
				printf("%s\n",sch[j].sch_id);
			}
			//printf("%s\n",s);
		}
		else{  
			test = strtok(s, " ");
			for(int j=0; test != NULL; j++)
			{
				if(j == 0)strcpy(sch[k].sta_no,test); 
				if(j == 1)strcpy(sch[k].addr, test); 
				if(j == 2)strcpy(sch[k].t_start, test); 
				if(j == 3){
				strncat(sch[k].t_start," ", 1); 	
				strncat(sch[k].t_start,test,strlen(test)); 
				}
				if(j == 4)strcpy(sch[k].t_stop, test); 
				if(j == 5){
				strncat(sch[k].t_stop, " ", 1); 
				strncat(sch[k].t_stop, test,strlen(test));
				} 
				if(j == 6){
					test = strtok(test, "\n");
					strcpy(sch[k].period, test);
				 	

				}
				
				//printf("%s\n", test);
				test = strtok(NULL, " ");
				
			}
			k++;
		     }
		i++;
	}
			for(int k=0;k<num-1;k++)
				printf("csts:%s %s %s %s %s %s\n",sch[k].sch_id,sch[k].sta_no, sch[k].addr,sch[k].t_start,sch[k].t_stop,sch[k].period);

}
