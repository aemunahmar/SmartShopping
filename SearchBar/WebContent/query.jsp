<%@ page import = "java.sql.*"%>
<%@ page import = "java.io.IOException" %>
<%@ page import = "java.nio.charset.StandardCharsets"%>
<%@ page import = "java.nio.file.Files"%>
<%@ page import = "java.nio.file.Paths"%>
<%@ page import = "java.text.DecimalFormat"%>
<%@ page import = "java.util.*"%>
<%@ page import = "java.util.stream.Collectors"%>
<%@ page import = "org.tartarus.snowball.ext.PorterStemmer"%>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Search</title>
	</head>
	
	<body onload="document.forms['search'].submit()">		
		<%
		//Create connection to database
			Connection conn = null;
			
			try 
			{
				Class.forName("com.mysql.cj.jdbc.Driver").newInstance();
				conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/productsdb", "root", "csci318project");
				
			} catch (Exception e) 
			{
				e.printStackTrace();
			}
		%>
		
		<%
			//Select criteria from database
			List<String[]> allProducts = new ArrayList<String[]>();
			
			Statement stmt = conn.createStatement();
			ResultSet rset = stmt.executeQuery("SELECT name, summary, type, brand FROM `productslist`");
			
			while(rset.next())
			{
				String[] product = new String[4];
	
				String name = rset.getString("name");
				String summary = rset.getString("summary");
				String type = rset.getString("type");
				String brand = rset.getString("brand");
				
				product[0] = name;
				product[1] = summary;
				product[2] = type;
				product[3] = brand;
				
				allProducts.add(product);
			}
	        
			stmt.close();
			conn.close();
		%>
		
		<%
			String swFile = "C:\\xampp\\tomcat\\webapps\\SearchBar\\WebContent\\Stopwords.txt";

			List<String> stopwords = new ArrayList<String>();	
			stopwords.addAll(Files.readAllLines(Paths.get(swFile), StandardCharsets.UTF_8));		
		%>
		
		<%
			List<List<String>> itemNames = new ArrayList<List<String>>();
			List<List<String>> itemSummaries = new ArrayList<List<String>>();
			List<List<String>> itemTypes = new ArrayList<List<String>>();
			List<List<String>> itemBrands = new ArrayList<List<String>>();
			
			//Tokenize Name
			for(String[] str: allProducts) 
		    {
				List<String> temp = new ArrayList<String>(); //temporary list
	
		        String currName = str[0].replaceAll("[^a-zA-Z\\s]", "");
		        StringTokenizer token = new StringTokenizer(currName, " ");
		    	while (token.hasMoreTokens()) 
		    	{
		    		temp.add(token.nextToken().toLowerCase());
		    	}
		    	temp.removeAll(stopwords);
			    java.util.Collections.sort(temp);
			    
			    itemNames.add(temp);
		    }
			
			//Tokenize Summary
			for(String[] str: allProducts) 
		    {
				List<String> temp = new ArrayList<String>(); //temporary list
	
		        String currSummary = str[1].replaceAll("[^a-zA-Z\\s]", "");
		        StringTokenizer token = new StringTokenizer(currSummary, " ");
		    	while (token.hasMoreTokens()) 
		    	{
		    		temp.add(token.nextToken().toLowerCase());
		    	}
		    	temp.removeAll(stopwords);
			    java.util.Collections.sort(temp);
			    
			    itemSummaries.add(temp);
		    }
			
			//Tokenize Type
			for(String[] str: allProducts) 
		    {
				List<String> temp = new ArrayList<String>(); //temporary list
	
		        String currType = str[2].replaceAll("[^a-zA-Z\\s]", "");
		        StringTokenizer token = new StringTokenizer(currType, " ");
		    	while (token.hasMoreTokens()) 
		    	{
		    		temp.add(token.nextToken().toLowerCase());
		    	}
		    	temp.removeAll(stopwords);
			    java.util.Collections.sort(temp);
			    
			    itemTypes.add(temp);
		    }
			
			//Tokenize Brand
			for(String[] str: allProducts) 
		    {
				List<String> temp = new ArrayList<String>(); //temporary list
	
		        String currBrand = str[3].replaceAll("[^a-zA-Z\\s]", "");
		        StringTokenizer token = new StringTokenizer(currBrand, " ");
		    	while (token.hasMoreTokens()) 
		    	{
		    		temp.add(token.nextToken().toLowerCase());
		    	}
		    	temp.removeAll(stopwords);
			    java.util.Collections.sort(temp);
			    
			    itemBrands.add(temp);
		    }
		%>
		
		<%
		//Stem all criteria for each item
			List<List<String>> stemmedNames = new ArrayList<List<String>>();
			List<List<String>> stemmedSummaries = new ArrayList<List<String>>();
			List<List<String>> stemmedTypes = new ArrayList<List<String>>();
			List<List<String>> stemmedBrands = new ArrayList<List<String>>();
	
			PorterStemmer stemmer = new PorterStemmer();

			//Stem Name
			for(List<String> name : itemNames)
			{
				List<String> temp = new ArrayList<String>(); //temporary list
				
				for(int i = 0; i < name.size(); i++)
			    {
					stemmer.setCurrent(name.get(i)); //set string you need to stem
					stemmer.stem();  //stem the word
					temp.add(stemmer.getCurrent()); //get the stemmed word
			    }
				
				stemmedNames.add(temp);
			}
			
			//Stem Summary
			for(List<String> summary : itemSummaries)
			{
				List<String> temp = new ArrayList<String>(); //temporary list
				
				for(int i = 0; i < summary.size(); i++)
			    {
					stemmer.setCurrent(summary.get(i)); //set string you need to stem
					stemmer.stem();  //stem the word
					temp.add(stemmer.getCurrent()); //get the stemmed word
			    }
				
				stemmedSummaries.add(temp);
			}
			
			//Stem Type
			for(List<String> type : itemTypes)
			{
				List<String> temp = new ArrayList<String>(); //temporary list
				
				for(int i = 0; i < type.size(); i++)
			    {
					stemmer.setCurrent(type.get(i)); //set string you need to stem
					stemmer.stem();  //stem the word
					temp.add(stemmer.getCurrent()); //get the stemmed word
			    }
				
				stemmedTypes.add(temp);
			}
			
			//Stem Type
			for(List<String> brand : itemBrands)
			{
				List<String> temp = new ArrayList<String>(); //temporary list
				
				for(int i = 0; i < brand.size(); i++)
			    {
					stemmer.setCurrent(brand.get(i)); //set string you need to stem
					stemmer.stem();  //stem the word
					temp.add(stemmer.getCurrent()); //get the stemmed word
			    }
				
				stemmedBrands.add(temp);
			}
		%>
		
		<%
			List<Map<String, Integer>> fmNames = new ArrayList<Map<String, Integer>>();
			List<Map<String, Integer>> fmSummaries = new ArrayList<Map<String, Integer>>();
			List<Map<String, Integer>> fmTypes = new ArrayList<Map<String, Integer>>();
			List<Map<String, Integer>> fmBrands = new ArrayList<Map<String, Integer>>();

			
		    for(List<String> item: stemmedNames) 
		    {
				Map<String, Integer> temp = new TreeMap<String, Integer>(); //temporary list
	
		    	for(String str : item)
		    	{
			        if(temp.get(str) == null) 
			        {
			        	temp.put(str, 1);
			        } else 
			        {
			        	temp.put(str, temp.get(str) + 1);
			        }
		    	}
		    	
		    	fmNames.add(temp);
		    }
		    
		    for(List<String> item: stemmedSummaries) 
		    {
				Map<String, Integer> temp = new TreeMap<String, Integer>(); //temporary list
	
		    	for(String str : item)
		    	{
			        if(temp.get(str) == null) 
			        {
			        	temp.put(str, 1);
			        } else 
			        {
			        	temp.put(str, temp.get(str) + 1);
			        }
		    	}
		    	
		    	fmSummaries.add(temp);
		    }
		    
		    for(List<String> item: stemmedTypes) 
		    {
				Map<String, Integer> temp = new TreeMap<String, Integer>(); //temporary list
	
		    	for(String str : item)
		    	{
			        if(temp.get(str) == null) 
			        {
			        	temp.put(str, 1);
			        } else 
			        {
			        	temp.put(str, temp.get(str) + 1);
			        }
		    	}
		    	
		    	fmTypes.add(temp);
		    }
		    
		    for(List<String> item: stemmedBrands) 
		    {
				Map<String, Integer> temp = new TreeMap<String, Integer>(); //temporary list
	
		    	for(String str : item)
		    	{
			        if(temp.get(str) == null) 
			        {
			        	temp.put(str, 1);
			        } else 
			        {
			        	temp.put(str, temp.get(str) + 1);
			        }
		    	}
		    	
		    	fmBrands.add(temp);
		    }
		%>
		
		<%
			Map<String, Integer> dfMap = new TreeMap<String, Integer>();
			
			for(Map<String, Integer> tfMap : fmNames)
			{
				for(int i = 0; i < tfMap.size(); i++)
				{
					String currTerm = (String) tfMap.keySet().toArray()[i];
					int currFreq = tfMap.get(currTerm);
					
					if(dfMap.containsKey(currTerm))
			        {
			        	dfMap.put(currTerm, dfMap.get(currTerm) + currFreq);
			        } else
			        {
			        	dfMap.put(currTerm, currFreq);
			        }
				}
			}
		
			for(Map<String, Integer> tfMap : fmSummaries)
			{
				for(int i = 0; i < tfMap.size(); i++)
				{
					String currTerm = (String) tfMap.keySet().toArray()[i];
					int currFreq = tfMap.get(currTerm);
					
					if(dfMap.containsKey(currTerm))
			        {
			        	dfMap.put(currTerm, dfMap.get(currTerm) + currFreq);
			        } else
			        {
			        	dfMap.put(currTerm, currFreq);
			        }
				}
			}
			
			for(Map<String, Integer> tfMap : fmTypes)
			{
				for(int i = 0; i < tfMap.size(); i++)
				{
					String currTerm = (String) tfMap.keySet().toArray()[i];
					int currFreq = tfMap.get(currTerm);
					
					if(dfMap.containsKey(currTerm))
			        {
			        	dfMap.put(currTerm, dfMap.get(currTerm) + currFreq);
			        } else
			        {
			        	dfMap.put(currTerm, currFreq);
			        }
				}
			}
			
			for(Map<String, Integer> tfMap : fmBrands)
			{
				for(int i = 0; i < tfMap.size(); i++)
				{
					String currTerm = (String) tfMap.keySet().toArray()[i];
					int currFreq = tfMap.get(currTerm);
					
					if(dfMap.containsKey(currTerm))
			        {
			        	dfMap.put(currTerm, dfMap.get(currTerm) + currFreq);
			        } else
			        {
			        	dfMap.put(currTerm, currFreq);
			        }
				}
			}
		%>
		
		<%
			List<double[]> tfIDFNames = new ArrayList<double[]>();
			List<double[]> tfIDFSummaries = new ArrayList<double[]>();
			List<double[]> tfIDFTypes = new ArrayList<double[]>();
			List<double[]> tfIDFBrands = new ArrayList<double[]>();

			Set<String> keys = dfMap.keySet();
			String[] allTerms = keys.toArray(new String[keys.size()]);
			
			int numNames = fmNames.size();
			int numSummaries = fmSummaries.size();
			int numTypes = fmTypes.size();
			int numBrands = fmBrands.size();
			
			for(Map<String, Integer> map : fmNames)
			{
				double[] vectorList = new double[dfMap.size()];
	
				double maxFreq = (double) Collections.max(map.values());
			
				for(int i = 0; i < allTerms.length; i++)
				{
					String currTerm = allTerms[i];
					
					if(map.containsKey(currTerm))
					{
						double tf = map.get(currTerm) / maxFreq;
						double idf = Math.log(numNames / dfMap.get(currTerm));
						double tfIDF = tf * idf;
																					
						vectorList[i] = tfIDF;
					} else
					{
						vectorList[i] = 0.0;
					}
				}
				
				tfIDFNames.add(vectorList);
			}
			
			for(Map<String, Integer> map : fmSummaries)
			{
				double[] vectorList = new double[dfMap.size()];
	
				double maxFreq = (double) Collections.max(map.values());
			
				for(int i = 0; i < allTerms.length; i++)
				{
					String currTerm = allTerms[i];
					
					if(map.containsKey(currTerm))
					{
						double tf = map.get(currTerm) / maxFreq;
						double idf = Math.log(numSummaries / dfMap.get(currTerm));
						double tfIDF = tf * idf;
																					
						vectorList[i] = tfIDF;
					} else
					{
						vectorList[i] = 0.0;
					}
				}
				
				tfIDFSummaries.add(vectorList);
			}
			
			for(Map<String, Integer> map : fmTypes)
			{
				double[] vectorList = new double[dfMap.size()];
	
				double maxFreq = (double) Collections.max(map.values());
			
				for(int i = 0; i < allTerms.length; i++)
				{
					String currTerm = allTerms[i];
					
					if(map.containsKey(currTerm))
					{
						double tf = map.get(currTerm) / maxFreq;
						double idf = Math.log(numTypes / dfMap.get(currTerm));
						double tfIDF = tf * idf;
																					
						vectorList[i] = tfIDF;
					} else
					{
						vectorList[i] = 0.0;
					}
				}
				
				tfIDFTypes.add(vectorList);
			}
			
			for(Map<String, Integer> map : fmBrands)
			{
				double[] vectorList = new double[dfMap.size()];
	
				double maxFreq = (double) Collections.max(map.values());
			
				for(int i = 0; i < allTerms.length; i++)
				{
					String currTerm = allTerms[i];
					
					if(map.containsKey(currTerm))
					{
						double tf = map.get(currTerm) / maxFreq;
						double idf = Math.log(numBrands / dfMap.get(currTerm));
						double tfIDF = tf * idf;
																					
						vectorList[i] = tfIDF;
					} else
					{
						vectorList[i] = 0.0;
					}
				}
				
				tfIDFBrands.add(vectorList);
			}
		%>
		
		<%			
			//Ask for search terms
			String query = request.getParameter("input").replaceAll("[^a-zA-Z\\s]", "");
								
			//Tokenize search terms and add to list
			List<String> searchTerms = new ArrayList<String>();
	
	        StringTokenizer token = new StringTokenizer(query, " ");
	    	while (token.hasMoreTokens()) 
	    	{
	    		searchTerms.add(token.nextToken().toLowerCase());
	    	}
	    	
	    	searchTerms.removeAll(stopwords);
		    java.util.Collections.sort(searchTerms);
		    
		    //Stem all the terms from the search term list
			List<String> stemmedTerms = new ArrayList<String>();
	
			
			for(String str : searchTerms)
			{			
				stemmer.setCurrent(str); //set string you need to stem
				stemmer.stem();  //stem the word
				stemmedTerms.add(stemmer.getCurrent()); //get the stemmed word
			}
			
			//Term Frequency of the terms in the search
			Map<String, Integer> termFreq = new TreeMap<String, Integer>();
	
			for(String str: stemmedTerms) 
		    {
				if(termFreq.get(str) == null) 
		        {
		        	termFreq.put(str, 1);
		        } else 
		        {
		        	termFreq.put(str, termFreq.get(str) + 1);
		        }
		    }
			
			//TFIDF			
			List<Double> queryList = new ArrayList<Double>();
	
			int numTerms = dfMap.size();
			double maxFreq = (double) Collections.max(termFreq.values());
			
			for(int i = 0; i < allTerms.length; i++)
			{			
				String currTerm = allTerms[i];
				
				if(termFreq.containsKey(currTerm))
				{
					double tf = termFreq.get(currTerm) / maxFreq;
					double idf = Math.log(numTerms / dfMap.get(currTerm));
					double tfIDF = tf * idf;
										
					queryList.add(tfIDF);
				} else
				{
					queryList.add(0.0);
				}
			}
			
			double[] queryVector = new double[dfMap.size()];
			
			for(int i = 0; i < queryList.size(); i++)
			{
				queryVector[i] = queryList.get(i);
			}	
			
		%>
		
		<%
	    	List<Double> smNames = new ArrayList<Double>();
	    	List<Double> smSummaries = new ArrayList<Double>();
	    	List<Double> smTypes = new ArrayList<Double>();
	    	List<Double> smBrands = new ArrayList<Double>();

	    	for(double[] tfidf : tfIDFNames)
	    	{
	        	double dotProduct = 0.0;
	            double magnitude1 = 0.0;
	            double magnitude2 = 0.0;
	            double cosineSimilarity = 0.0;
	            
	            for (int i = 0; i < tfidf.length; i++)
	            {
	                dotProduct += tfidf[i] * queryVector[i]; //a.b
	                magnitude1 += Math.pow(tfidf[i], 2); //(a^2)
	                magnitude2 += Math.pow(queryVector[i], 2); //(b^2)
	            }

	            magnitude1 = Math.sqrt(magnitude1); //sqrt(a^2)
	            magnitude2 = Math.sqrt(magnitude2); //sqrt(b^2)

	            if (magnitude1 != 0.0 | magnitude2 != 0.0) 
	            {
	                cosineSimilarity = dotProduct / (magnitude1 * magnitude2);
	            } else 
	            {
	                cosineSimilarity = 0.0;
	            }
	            
	    		smNames.add(cosineSimilarity);
	    	}
	    	
	    	for(double[] tfidf : tfIDFSummaries)
	    	{
	        	double dotProduct = 0.0;
	            double magnitude1 = 0.0;
	            double magnitude2 = 0.0;
	            double cosineSimilarity = 0.0;
	            
	            for (int i = 0; i < tfidf.length; i++)
	            {
	                dotProduct += tfidf[i] * queryVector[i]; //a.b
	                magnitude1 += Math.pow(tfidf[i], 2); //(a^2)
	                magnitude2 += Math.pow(queryVector[i], 2); //(b^2)
	            }

	            magnitude1 = Math.sqrt(magnitude1); //sqrt(a^2)
	            magnitude2 = Math.sqrt(magnitude2); //sqrt(b^2)

	            if (magnitude1 != 0.0 | magnitude2 != 0.0) 
	            {
	                cosineSimilarity = dotProduct / (magnitude1 * magnitude2);
	            } else 
	            {
	                cosineSimilarity = 0.0;
	            }
	            
	    		smSummaries.add(cosineSimilarity);
	    	}
	    	
	    	for(double[] tfidf : tfIDFTypes)
	    	{
	        	double dotProduct = 0.0;
	            double magnitude1 = 0.0;
	            double magnitude2 = 0.0;
	            double cosineSimilarity = 0.0;
	            
	            for (int i = 0; i < tfidf.length; i++)
	            {
	                dotProduct += tfidf[i] * queryVector[i]; //a.b
	                magnitude1 += Math.pow(tfidf[i], 2); //(a^2)
	                magnitude2 += Math.pow(queryVector[i], 2); //(b^2)
	            }

	            magnitude1 = Math.sqrt(magnitude1); //sqrt(a^2)
	            magnitude2 = Math.sqrt(magnitude2); //sqrt(b^2)

	            if (magnitude1 != 0.0 | magnitude2 != 0.0) 
	            {
	                cosineSimilarity = dotProduct / (magnitude1 * magnitude2);
	            } else 
	            {
	                cosineSimilarity = 0.0;
	            }
	            
	    		smTypes.add(cosineSimilarity);
	    	}
	    	
	    	for(double[] tfidf : tfIDFBrands)
	    	{
	        	double dotProduct = 0.0;
	            double magnitude1 = 0.0;
	            double magnitude2 = 0.0;
	            double cosineSimilarity = 0.0;
	            
	            for (int i = 0; i < tfidf.length; i++)
	            {
	                dotProduct += tfidf[i] * queryVector[i]; //a.b
	                magnitude1 += Math.pow(tfidf[i], 2); //(a^2)
	                magnitude2 += Math.pow(queryVector[i], 2); //(b^2)
	            }

	            magnitude1 = Math.sqrt(magnitude1); //sqrt(a^2)
	            magnitude2 = Math.sqrt(magnitude2); //sqrt(b^2)

	            if (magnitude1 != 0.0 | magnitude2 != 0.0) 
	            {
	                cosineSimilarity = dotProduct / (magnitude1 * magnitude2);
	            } else 
	            {
	                cosineSimilarity = 0.0;
	            }
	            
	    		smBrands.add(cosineSimilarity);
	    	}
		%>
		
		<%
    		List<Double> similarityMatrix = new ArrayList<Double>();
			Map<Integer, Double> temp = new HashMap<Integer, Double>();
			
			for(int i = 0; i < smNames.size(); i++)
			{
				double n = smNames.get(i);
				double s = smSummaries.get(i);
				double t = smTypes.get(i);
				double b = smBrands.get(i);
				
				double avgSimilarity = (n + s + t + b);
				
				similarityMatrix.add(avgSimilarity);
			}
			
			for(int i = 0; i < similarityMatrix.size(); i++)
			{
				if(similarityMatrix.get(i) > 0.250)
				{
					temp.put(i + 1, similarityMatrix.get(i));
				}
			}
			
			LinkedHashMap<Integer, Double> sortedMap = new LinkedHashMap<Integer, Double>();
			
			sortedMap = temp.entrySet().stream().sorted(Collections.reverseOrder(Map.Entry.comparingByValue())).collect(
	            Collectors.toMap(Map.Entry::getKey, Map.Entry::getValue, (e1, e2) -> e2, LinkedHashMap::new));
		%>
		
		<%
			int[] itemNum = new int[sortedMap.size()];
			
			int count = 0;
			for(Integer i : sortedMap.keySet())
			{
				itemNum[count] = i;
				count++;
			}
		%>
		
		<form action = "searchresult.php" method = "get" name = "search">
		<% for(int i = 0; i < itemNum.length; i++) { %>
			<input type="hidden" name="item<%out.print(i);%>" value="<%out.print(itemNum[i]);%>">
		<% } %>
		</form>
	</body>
</html>